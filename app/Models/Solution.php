<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'page_content',
        'short_description',
        'icon_svg',
        'show_in_navbar',
        'route_name',
        'sort_order',
        'author',
        'published_at',
    ];

    protected $casts = [
        'page_content' => 'array',
        'show_in_navbar' => 'boolean',
        'sort_order' => 'integer',
        'published_at' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($solution) {
            if (empty($solution->slug)) {
                $solution->slug = Str::slug($solution->name);
            }
            if (empty($solution->published_at)) {
                $solution->published_at = now();
            }
        });
    }

    /**
     * Public dedicated page URL for this solution
     */
    public function publicUrl(): string
    {
        if (!empty($this->route_name) && Route::has($this->route_name)) {
            return route($this->route_name);
        }

        if (Route::has('solutions.public.show')) {
            return route('solutions.public.show', $this->slug);
        }

        return url('/solution/' . $this->slug);
    }

    /**
     * Sanitize stored icon_svg to prevent script/event-handler XSS when rendered inline.
     */
    public function safeIconHtml(): string
    {
        $raw = trim((string) $this->icon_svg);
        if ($raw === '') {
            return '<svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2"></rect><path stroke-linecap="round" d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"></path></svg>';
        }

        // Strip dangerous elements and inline event/script URIs
        $clean = preg_replace('#<\s*(script|foreignObject|iframe|object|embed|style|link|meta)[^>]*>.*?<\s*/\s*\1\s*>#is', '', $raw) ?? '';
        $clean = preg_replace('#<\s*(script|foreignObject|iframe|object|embed|style|link|meta)[^>]*\/?>#is', '', $clean) ?? '';
        $clean = preg_replace('#\s+on[a-z0-9_-]+\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+)#is', '', $clean) ?? '';
        $clean = preg_replace('#(?:javascript|vbscript|data)\s*:#is', 'blocked:', $clean) ?? '';

        if (str_contains(strtolower($clean), '<svg')) {
            return $clean;
        }

        return '<svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">' . $clean . '</svg>';
    }

    /**
     * Normalized page content structure with clean defaults
     */
    public function resolvedPageContent(): array
    {
        $raw = is_array($this->page_content) ? $this->page_content : [];

        $stats = [];
        if (!empty($raw['stats']) && is_array($raw['stats'])) {
            foreach ($raw['stats'] as $st) {
                $val = trim((string) ($st['value'] ?? ''));
                $lbl = trim((string) ($st['label'] ?? ''));
                if ($val !== '' || $lbl !== '') {
                    $stats[] = ['value' => $val, 'label' => $lbl];
                }
            }
        }
        if (empty($stats)) {
            $stats = [
                ['value' => '200+', 'label' => 'Industrial Client Projects'],
                ['value' => '1,000+', 'label' => 'CAD & Electrical Drawings'],
                ['value' => 'IEC 61439', 'label' => 'Panel & Wiring Compliance'],
            ];
        }

        $deliverables = [];
        if (!empty($raw['deliverables']) && is_array($raw['deliverables'])) {
            foreach ($raw['deliverables'] as $del) {
                $title = trim((string) ($del['title'] ?? ''));
                $desc = trim((string) ($del['description'] ?? ''));
                $highlights = [];
                if (!empty($del['highlights']) && is_array($del['highlights'])) {
                    foreach ($del['highlights'] as $hl) {
                        $hlText = trim((string) $hl);
                        if ($hlText !== '') {
                            $highlights[] = $hlText;
                        }
                    }
                }
                if ($title !== '' || $desc !== '') {
                    $deliverables[] = [
                        'title' => $title,
                        'description' => $desc,
                        'highlights' => $highlights,
                    ];
                }
            }
        }

        $processSteps = [];
        if (!empty($raw['process_steps']) && is_array($raw['process_steps'])) {
            foreach ($raw['process_steps'] as $step) {
                $title = trim((string) ($step['title'] ?? ''));
                $desc = trim((string) ($step['description'] ?? ''));
                if ($title !== '' || $desc !== '') {
                    $processSteps[] = ['title' => $title, 'description' => $desc];
                }
            }
        }

        $faqs = [];
        if (!empty($raw['faqs']) && is_array($raw['faqs'])) {
            foreach ($raw['faqs'] as $faq) {
                $q = trim((string) ($faq['question'] ?? ''));
                $a = trim((string) ($faq['answer'] ?? ''));
                if ($q !== '' || $a !== '') {
                    $faqs[] = ['question' => $q, 'answer' => $a];
                }
            }
        }

        $tags = [];
        if (!empty($raw['tags']) && is_array($raw['tags'])) {
            foreach ($raw['tags'] as $t) {
                $tag = trim((string) $t);
                if ($tag !== '') {
                    $tags[] = $tag;
                }
            }
        }

        return [
            'hero_subtitle' => trim((string) ($raw['hero_subtitle'] ?? '')) ?: ($this->short_description ?: 'Industrial Engineering & Turnkey Automation Solution'),
            'stats' => $stats,
            'tags' => $tags,
            'deliverables_subtitle' => trim((string) ($raw['deliverables_subtitle'] ?? '')) ?: 'Comprehensive industrial engineering capabilities tailored to your plant floor.',
            'deliverables' => $deliverables,
            'process_subtitle' => trim((string) ($raw['process_subtitle'] ?? '')) ?: 'A structured engineering methodology guaranteeing seamless deployment and high uptime.',
            'process_steps' => $processSteps,
            'faqs' => $faqs,
            'cta_title' => trim((string) ($raw['cta_title'] ?? '')) ?: 'Ready to Implement ' . $this->name . '?',
            'cta_description' => trim((string) ($raw['cta_description'] ?? '')) ?: 'Contact our automation engineering team to discuss your line specifications, cycle time goals, and custom integration blueprint.',
            'cta_button_text' => trim((string) ($raw['cta_button_text'] ?? '')) ?: 'Get A Quote / Consultation',
        ];
    }
}
