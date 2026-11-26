<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectAdminController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->query('search', ''));
        $category = $request->query('category', 'all');
        $visibility = $request->query('visibility', 'all');

        $query = Project::query()->orderBy('sort_order')->latest();

        if ($category !== 'all' && !empty($category)) {
            $query->where('category', $category);
        }
        if ($visibility === 'shown') {
            $query->where('is_featured', true);
        } elseif ($visibility === 'hidden') {
            $query->where('is_featured', false);
        }
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('year', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $projects = $query->paginate(12)->withQueryString();
        $totalProjects = Project::count();
        $shownProjectsCount = Project::where('is_featured', true)->count();

        $defaultCategories = [
            'Automotive',
            'FMCG & Food',
            'Pharmaceutical',
            'Packaging',
            'Smart BMS',
            'Critical Infrastructure',
            'Agrochemical & Utilities',
            'Machine Vision',
            'PLC Automation',
        ];
        $dbCategories = Project::whereNotNull('category')->distinct()->pluck('category')->filter()->toArray();
        $categories = collect(array_merge($defaultCategories, $dbCategories))->unique()->values();

        return view('admin.projects.index', compact(
            'projects',
            'totalProjects',
            'shownProjectsCount',
            'categories',
            'search',
            'category',
            'visibility'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:200',
            'category' => 'required|string|max:100',
            'year' => 'nullable|string|max:10',
            'description' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        $nextOrder = Project::max('sort_order') + 1;

        Project::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
            'client_name' => $validated['client_name'] ?? null,
            'category' => $validated['category'],
            'year' => $validated['year'] ?: date('Y'),
            'description' => $validated['description'],
            'image' => $imagePath,
            'is_featured' => $request->boolean('is_featured'),
            'sort_order' => isset($validated['sort_order']) ? (int) $validated['sort_order'] : $nextOrder,
        ]);

        return back()->with('success', 'Proyek "' . $validated['title'] . '" berhasil ditambahkan.');
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:200',
            'category' => 'required|string|max:100',
            'year' => 'nullable|string|max:10',
            'description' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image && str_starts_with($project->image, 'projects/') && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }
            $project->image = $request->file('image')->store('projects', 'public');
        }

        $project->update([
            'title' => $validated['title'],
            'client_name' => $validated['client_name'] ?? null,
            'category' => $validated['category'],
            'year' => $validated['year'] ?: $project->year,
            'description' => $validated['description'],
            'is_featured' => $request->boolean('is_featured'),
            'sort_order' => isset($validated['sort_order']) ? (int) $validated['sort_order'] : $project->sort_order,
        ]);

        return back()->with('success', 'Proyek "' . $project->title . '" berhasil diperbarui.');
    }

    public function toggleStatus(Project $project): RedirectResponse
    {
        $project->update([
            'is_featured' => !$project->is_featured,
        ]);

        $statusLabel = $project->is_featured ? 'TAYANG' : 'HIDDEN';

        return back()->with('success', 'Status proyek "' . $project->title . '" diubah menjadi ' . $statusLabel . '.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $title = $project->title;
        if ($project->image && str_starts_with($project->image, 'projects/') && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();

        return back()->with('success', 'Proyek "' . $title . '" berhasil dihapus dari sistem.');
    }
}
