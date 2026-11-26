<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SolutionController extends Controller
{
    /**
     * Halaman publik detail solusi berdasarkan slug (untuk solusi baru / dinamis)
     */
    public function showPublic(Solution $solution): View
    {
        return view('public.solution-detail', compact('solution'));
    }

    /**
     * Halaman publik detail solusi untuk 6 route utama bawaan
     */
    public function showBySlug(string $slug): View
    {
        $solution = Solution::where('slug', $slug)->firstOrFail();

        return view('public.solution-detail', compact('solution'));
    }

    /**
     * Halaman index admin untuk mengelola Solusi
     */
    public function index(Request $request): View
    {
        $search = trim($request->query('search', ''));
        $visibility = $request->query('visibility', 'all');

        $query = Solution::query()->orderBy('sort_order')->latest();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        if ($visibility === 'shown') {
            $query->where('show_in_navbar', true);
        } elseif ($visibility === 'hidden') {
            $query->where('show_in_navbar', false);
        }

        $solutions = $query->paginate(12)->withQueryString();
        $totalSolutions = Solution::count();
        $shownSolutionsCount = Solution::where('show_in_navbar', true)->count();

        return view('admin.solutions.index', compact(
            'solutions',
            'totalSolutions',
            'shownSolutionsCount',
            'search',
            'visibility'
        ));
    }

    /**
     * Sanitize & parse JSON page_content payload from the tabbed solution builder
     */
    private function extractPageContent(Request $request, ?array $fallback = null): ?array
    {
        $rawJson = $request->input('page_content_json');
        if (empty($rawJson)) {
            return $fallback;
        }

        $decoded = json_decode($rawJson, true);
        if (!is_array($decoded)) {
            return $fallback;
        }

        $stats = [];
        foreach (($decoded['stats'] ?? []) as $st) {
            if (!is_array($st)) {
                continue;
            }
            $value = trim((string) ($st['value'] ?? ''));
            $label = trim((string) ($st['label'] ?? ''));
            if ($value !== '' || $label !== '') {
                $stats[] = ['value' => $value, 'label' => $label];
            }
        }

        $tags = [];
        $tagsInput = $decoded['tags'] ?? [];
        if (is_string($tagsInput)) {
            $tagsInput = explode(',', $tagsInput);
        }
        foreach ((array) $tagsInput as $t) {
            $tag = trim((string) $t);
            if ($tag !== '') {
                $tags[] = $tag;
            }
        }

        $deliverables = [];
        foreach (($decoded['deliverables'] ?? []) as $del) {
            if (!is_array($del)) {
                continue;
            }
            $title = trim((string) ($del['title'] ?? ''));
            $desc = trim((string) ($del['description'] ?? ''));
            $highlights = [];
            foreach ((array) ($del['highlights'] ?? []) as $hl) {
                $hlStr = trim((string) $hl);
                if ($hlStr !== '') {
                    $highlights[] = $hlStr;
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

        $processSteps = [];
        foreach (($decoded['process_steps'] ?? []) as $step) {
            if (!is_array($step)) {
                continue;
            }
            $title = trim((string) ($step['title'] ?? ''));
            $desc = trim((string) ($step['description'] ?? ''));
            if ($title !== '' || $desc !== '') {
                $processSteps[] = ['title' => $title, 'description' => $desc];
            }
        }

        $faqs = [];
        foreach (($decoded['faqs'] ?? []) as $faq) {
            if (!is_array($faq)) {
                continue;
            }
            $q = trim((string) ($faq['question'] ?? ''));
            $a = trim((string) ($faq['answer'] ?? ''));
            if ($q !== '' || $a !== '') {
                $faqs[] = ['question' => $q, 'answer' => $a];
            }
        }

        return [
            'hero_subtitle' => trim((string) ($decoded['hero_subtitle'] ?? '')),
            'stats' => $stats,
            'tags' => array_values(array_unique($tags)),
            'deliverables_subtitle' => trim((string) ($decoded['deliverables_subtitle'] ?? '')),
            'deliverables' => $deliverables,
            'process_subtitle' => trim((string) ($decoded['process_subtitle'] ?? '')),
            'process_steps' => $processSteps,
            'faqs' => $faqs,
            'cta_title' => trim((string) ($decoded['cta_title'] ?? '')),
            'cta_description' => trim((string) ($decoded['cta_description'] ?? '')),
            'cta_button_text' => trim((string) ($decoded['cta_button_text'] ?? '')),
        ];
    }

    /**
     * Simpan solusi baru
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'show_in_navbar' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
            'page_content_json' => 'nullable|string',
        ]);

        $imagePath = 'solution_default.jpg';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('solutions', 'public');
        }

        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Solution::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $nextOrder = Solution::max('sort_order') + 1;

        Solution::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'],
            'page_content' => $this->extractPageContent($request),
            'image' => $imagePath,
            'show_in_navbar' => $request->boolean('show_in_navbar'),
            'sort_order' => isset($validated['sort_order']) ? (int) $validated['sort_order'] : $nextOrder,
            'author' => 'PT GAT Engineering',
            'published_at' => now(),
        ]);

        return back()->with('success', 'Solusi & halaman "' . $validated['name'] . '" berhasil dibuat dan otomatis tayang.');
    }

    /**
     * Update solusi & seluruh isi halamannya
     */
    public function update(Request $request, Solution $solution): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'show_in_navbar' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
            'page_content_json' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($solution->image && $solution->image !== 'solution_default.jpg' && Storage::disk('public')->exists($solution->image)) {
                Storage::disk('public')->delete($solution->image);
            }
            $solution->image = $request->file('image')->store('solutions', 'public');
        }

        $coreSlugs = ['plc-progamming', 'inspection', 'software', 'intergrator', 'laser-marking', 'strapping'];
        $slug = $solution->slug;
        if (!in_array($solution->slug, $coreSlugs, true) && empty($solution->route_name)) {
            $baseSlug = Str::slug($validated['name']);
            $candidateSlug = $baseSlug;
            $counter = 1;
            while (Solution::where('slug', $candidateSlug)->where('id', '!=', $solution->id)->exists()) {
                $candidateSlug = $baseSlug . '-' . $counter++;
            }
            $slug = $candidateSlug;
        }

        $solution->update([
            'name' => $validated['name'],
            'slug' => $slug,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'],
            'page_content' => $this->extractPageContent($request, $solution->page_content),
            'show_in_navbar' => $request->boolean('show_in_navbar'),
            'sort_order' => isset($validated['sort_order']) ? (int) $validated['sort_order'] : $solution->sort_order,
        ]);

        return back()->with('success', 'Solusi & isi halaman "' . $solution->name . '" berhasil diperbarui.');
    }

    /**
     * Toggle status penayangan solusi di Navbar & halaman Solusi publik
     */
    public function toggleNavbar(Solution $solution): RedirectResponse
    {
        $solution->update([
            'show_in_navbar' => !$solution->show_in_navbar,
        ]);

        $statusLabel = $solution->show_in_navbar ? 'TAYANG' : 'HIDDEN';

        return back()->with('success', 'Status solusi "' . $solution->name . '" diubah menjadi ' . $statusLabel . '.');
    }

    /**
     * Ubah urutan tampil solusi (naik/turun atau angka langsung)
     */
    public function reorder(Request $request, Solution $solution): RedirectResponse
    {
        $validated = $request->validate([
            'direction' => 'nullable|in:up,down',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if (!empty($validated['direction'])) {
            $ordered = Solution::orderBy('sort_order')->orderBy('id')->get()->values();
            $currentIndex = $ordered->search(fn ($item) => $item->id === $solution->id);

            if ($currentIndex !== false) {
                $targetIndex = $validated['direction'] === 'up' ? $currentIndex - 1 : $currentIndex + 1;

                if ($targetIndex >= 0 && $targetIndex < $ordered->count()) {
                    $list = $ordered->all();
                    [$list[$currentIndex], $list[$targetIndex]] = [$list[$targetIndex], $list[$currentIndex]];

                    foreach ($list as $idx => $item) {
                        $item->update(['sort_order' => $idx + 1]);
                    }
                }
            }

            return back()->with('success', 'Urutan tampil solusi "' . $solution->name . '" berhasil diperbarui.');
        }

        if (isset($validated['sort_order'])) {
            $solution->update(['sort_order' => (int) $validated['sort_order']]);
            return back()->with('success', 'Urutan solusi "' . $solution->name . '" diubah menjadi #' . (int) $validated['sort_order'] . '.');
        }

        return back();
    }

    /**
     * Hapus solusi
     */
    public function destroy(Solution $solution): RedirectResponse
    {
        $name = $solution->name;
        if ($solution->image && $solution->image !== 'solution_default.jpg' && Storage::disk('public')->exists($solution->image)) {
            Storage::disk('public')->delete($solution->image);
        }
        $solution->delete();

        return back()->with('success', 'Solusi "' . $name . '" berhasil dihapus.');
    }
}
