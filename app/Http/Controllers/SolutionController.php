<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class SolutionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['auth', 'is_admin'], except: ['publicIndex', 'show']),
        ];
    }

    // Menampilkan solusi untuk publik
    public function publicIndex()
    {
        $solutions = Solution::latest()->get();

        return view('solution.index', compact('solutions'));
    }

    // Halaman admin untuk mengelola solusi
    public function adminIndex()
    {
        $solutions = Solution::latest()->get();

        return view('admin.solution.index', compact('solutions'));
    }

    // Form tambah solusi
    public function create()
    {
        return view('admin.solution.create');
    }

    // Menyimpan solusi baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:solutions,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        $data = $validatedData;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Solution::create($data);

        return redirect()->route('solution.adminIndex')->with('success', 'Solusi berhasil ditambahkan.');
    }

    // Menampilkan detail solusi
    public function show(Solution $solution)
    {
        return view('solution.show', compact('solution'));
    }

    // Form edit solusi
    public function edit(Solution $solution)
    {
        return view('admin.solution.edit', compact('solution'));
    }

    // Mengupdate solusi
    public function update(Request $request, Solution $solution)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:solutions,name,'.$solution->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        $data = $validatedData;

        if ($request->hasFile('image')) {
            if ($solution->image) {
                Storage::disk('public')->delete($solution->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $solution->update($data);

        return redirect()->route('solution.adminIndex')->with('success', 'Solusi berhasil diperbarui.');
    }

    // Menghapus solusi
    public function destroy(Solution $solution)
    {
        if ($solution->image) {
            Storage::disk('public')->delete($solution->image);
        }

        $solution->delete();

        return redirect()->route('solution.adminIndex')->with('success', 'Solusi berhasil dihapus.');
    }
}
