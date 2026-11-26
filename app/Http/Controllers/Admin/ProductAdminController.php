<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductAdminController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->query('search', ''));
        $categoryId = $request->query('category', 'all');
        $status = $request->query('status', 'all');

        $query = Product::with('category')->latest();

        if ($categoryId !== 'all' && !empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }
        if ($status !== 'all' && in_array($status, ['published', 'draft', 'archived'])) {
            $query->where('status', $status);
        }
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = ProductCategory::where('is_active', true)->orderBy('name')->get();
        $allCategories = ProductCategory::withCount('products')->orderBy('name')->get();
        $totalProducts = Product::count();
        $publishedProducts = Product::where('status', 'published')->count();
        $draftProducts = Product::where('status', 'draft')->count();

        return view('admin.products.index', compact(
            'products',
            'categories',
            'allCategories',
            'totalProducts',
            'publishedProducts',
            'draftProducts',
            'search',
            'categoryId',
            'status'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku',
            'short_description' => 'required|string|max:500',
            'description' => 'nullable|string|max:5000',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'min_order_quantity' => 'nullable|integer|min:1',
            'is_rfq_only' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:published,draft,archived',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'spec_groups_json' => 'nullable|string',
            'specifications_text' => 'nullable|string',
            'specs_keys' => 'nullable|array',
            'specs_values' => 'nullable|array',
        ]);

        $imagePath = 'products/default.jpg';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Parse specifications: prioritas dari input baris terstruktur (specs_keys & specs_values)
        $specs = $this->parseSpecifications($request, $validated['specifications_text'] ?? null);

        Product::create([
            'category_id' => $validated['category_id'],
            'sku' => strtoupper(trim($validated['sku'])),
            'name' => trim($validated['name']),
            'slug' => Str::slug($validated['name']) . '-' . Str::random(5),
            'short_description' => trim($validated['short_description']),
            'description' => $validated['description'] ?? $validated['short_description'],
            'price' => $validated['price'] ?? 0,
            'stock' => $validated['stock'] ?? 10,
            'min_order_quantity' => $validated['min_order_quantity'] ?? 1,
            'is_rfq_only' => $request->boolean('is_rfq_only', true),
            'is_featured' => $request->boolean('is_featured', false),
            'status' => $validated['status'],
            'image' => $imagePath,
            'specifications' => $specs,
        ]);

        return back()->with('success', 'Produk baru berhasil ditambahkan ke katalog.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'short_description' => 'required|string|max:500',
            'description' => 'nullable|string|max:5000',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'min_order_quantity' => 'nullable|integer|min:1',
            'is_rfq_only' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:published,draft,archived',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'spec_groups_json' => 'nullable|string',
            'specifications_text' => 'nullable|string',
            'specs_keys' => 'nullable|array',
            'specs_values' => 'nullable|array',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image && !str_starts_with($product->image, 'http') && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Parse specifications (termasuk spec_groups_json dari modal edit modern)
        if ($request->has('spec_groups_json') || $request->has('specs_keys') || !empty($validated['specifications_text'])) {
            $specs = $this->parseSpecifications($request, $validated['specifications_text'] ?? null);
        } else {
            $specs = $product->specifications ?? [];
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'sku' => strtoupper(trim($validated['sku'])),
            'name' => trim($validated['name']),
            'short_description' => trim($validated['short_description']),
            'description' => $validated['description'] ?? $product->description,
            'price' => $validated['price'] ?? $product->price,
            'stock' => $validated['stock'] ?? $product->stock,
            'min_order_quantity' => $validated['min_order_quantity'] ?? $product->min_order_quantity,
            'is_rfq_only' => $request->boolean('is_rfq_only', true),
            'is_featured' => $request->boolean('is_featured', false),
            'status' => $validated['status'],
            'image' => $imagePath,
            'specifications' => $specs,
        ]);

        return back()->with('success', "Data produk '{$product->name}' berhasil diperbarui.");
    }

    public function toggleStatus(Product $product): RedirectResponse
    {
        $newStatus = $product->status === 'published' ? 'draft' : 'published';
        $product->update(['status' => $newStatus]);

        $label = $newStatus === 'published' ? 'ditayangkan (Published)' : 'disembunyikan (Draft)';
        return back()->with('success', "Status produk '{$product->name}' berhasil diubah menjadi {$label}.");
    }

    public function toggleFeatured(Product $product): RedirectResponse
    {
        $newFeatured = !$product->is_featured;
        $product->update(['is_featured' => $newFeatured]);

        $label = $newFeatured ? 'ditandai sebagai Produk Pilihan (Featured)' : 'dihapus dari Produk Pilihan';
        return back()->with('success', "Status unggulan produk '{$product->name}' berhasil diperbarui.");
    }

    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;
        if ($product->image && !str_starts_with($product->image, 'http') && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return back()->with('success', "Produk '{$name}' berhasil dihapus dari katalog.");
    }

    /**
     * Tambah Kategori Produk Baru langsung dari Dashboard
     */
    public function storeCategory(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:120|unique:product_categories,name',
            'category_description' => 'nullable|string|max:300',
        ], [
            'category_name.required' => 'Nama kategori produk wajib diisi.',
            'category_name.unique' => 'Nama kategori tersebut sudah terdaftar.',
        ]);

        $baseSlug = Str::slug($validated['category_name']);
        $slug = $baseSlug ?: ('kategori-' . Str::random(5));
        $counter = 1;
        while (ProductCategory::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        ProductCategory::create([
            'name' => trim($validated['category_name']),
            'slug' => $slug,
            'description' => trim((string) ($validated['category_description'] ?? '')) ?: null,
            'is_active' => true,
        ]);

        return back()
            ->with('open_category_modal', true)
            ->with('success', 'Kategori produk "' . trim($validated['category_name']) . '" berhasil ditambahkan.');
    }

    /**
     * Perbarui Nama & Deskripsi Kategori Produk
     */
    public function updateCategory(Request $request, ProductCategory $category): RedirectResponse
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:120|unique:product_categories,name,' . $category->id,
            'category_description' => 'nullable|string|max:300',
        ], [
            'category_name.required' => 'Nama kategori produk wajib diisi.',
            'category_name.unique' => 'Nama kategori tersebut sudah dipakai kategori lain.',
        ]);

        $baseSlug = Str::slug($validated['category_name']);
        $slug = $baseSlug ?: $category->slug;
        $counter = 1;
        while (ProductCategory::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $category->update([
            'name' => trim($validated['category_name']),
            'slug' => $slug,
            'description' => trim((string) ($validated['category_description'] ?? '')) ?: null,
        ]);

        return back()
            ->with('open_category_modal', true)
            ->with('success', 'Kategori "' . $category->name . '" berhasil diperbarui.');
    }

    /**
     * Toggle Aktif / Nonaktif Kategori Produk
     */
    public function toggleCategory(ProductCategory $category): RedirectResponse
    {
        $category->update(['is_active' => ! $category->is_active]);
        $label = $category->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()
            ->with('open_category_modal', true)
            ->with('success', 'Kategori "' . $category->name . '" berhasil ' . $label . '.');
    }

    /**
     * Hapus Kategori Produk (diblokir aman jika masih digunakan produk)
     */
    public function destroyCategory(ProductCategory $category): RedirectResponse
    {
        $usedCount = $category->products()->count();
        if ($usedCount > 0) {
            return back()
                ->with('open_category_modal', true)
                ->withErrors([
                    'category_name' => "Kategori \"{$category->name}\" masih dipakai oleh {$usedCount} produk. Pindahkan produk ke kategori lain terlebih dahulu.",
                ]);
        }

        $name = $category->name;
        $category->delete();

        return back()
            ->with('open_category_modal', true)
            ->with('success', 'Kategori "' . $name . '" berhasil dihapus.');
    }

    /**
     * Parse structured specification keys and values into associative array
     * Mendukung Pilihan Spesifikasi Quotation (Variasi Opsi & Status Aktif/Nonaktif)
     */
    private function parseSpecifications(Request $request, ?string $fallbackText = null): array
    {
        // 1. Prioritas Utama: Structured Spec Groups JSON (Varian Pilihan & Status Aktif/Nonaktif)
        if ($request->filled('spec_groups_json')) {
            $rawGroups = json_decode($request->input('spec_groups_json'), true);
            if (is_array($rawGroups) && !empty($rawGroups)) {
                $specs = [];
                foreach ($rawGroups as $grp) {
                    $paramName = trim((string)($grp['name'] ?? ''));
                    if ($paramName === '') continue;

                    $options = [];
                    $rawOptions = (array)($grp['options'] ?? []);
                    foreach ($rawOptions as $opt) {
                        $val = trim((string)($opt['value'] ?? ''));
                        if ($val === '') continue;
                        $isActive = isset($opt['is_active']) ? (bool)$opt['is_active'] : true;
                        $options[] = [
                            'value' => $val,
                            'is_active' => $isActive,
                        ];
                    }

                    if (!empty($options)) {
                        $specs[$paramName] = $options;
                    }
                }
                if (!empty($specs)) {
                    return $specs;
                }
            }
        }

        $specs = [];

        // 2. Fallback: Array keys & values
        if ($request->has('specs_keys') && $request->has('specs_values')) {
            $keys = (array) $request->input('specs_keys');
            $values = (array) $request->input('specs_values');

            foreach ($keys as $idx => $k) {
                $k = trim((string)$k);
                $v = trim((string)($values[$idx] ?? ''));
                if ($k !== '' && $v !== '') {
                    if (str_contains($v, ', ') || str_contains($v, ' / ')) {
                        $delimiter = str_contains($v, ' / ') ? ' / ' : ', ';
                        $opts = array_values(array_filter(array_map('trim', explode($delimiter, $v))));
                        $specs[$k] = count($opts) > 1 
                            ? array_map(fn($o) => ['value' => $o, 'is_active' => true], $opts)
                            : [['value' => $v, 'is_active' => true]];
                    } else {
                        $specs[$k] = [['value' => $v, 'is_active' => true]];
                    }
                }
            }
            if (!empty($specs)) {
                return $specs;
            }
        }

        // 3. Fallback: Raw Text lines
        if (!empty($fallbackText)) {
            $lines = explode("\n", str_replace("\r", "", $fallbackText));
            foreach ($lines as $line) {
                if (str_contains($line, ':')) {
                    [$k, $v] = explode(':', $line, 2);
                    $k = trim($k);
                    $v = trim($v);
                    if ($k !== '' && $v !== '') {
                        $specs[$k] = [['value' => $v, 'is_active' => true]];
                    }
                }
            }
        }

        return $specs;
    }
}
