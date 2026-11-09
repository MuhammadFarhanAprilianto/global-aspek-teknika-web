<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Halaman katalog produk publik (Hybrid Company Profile & E-Commerce)
     * Dilengkapi filter kategori dropdown dan kotak pencarian cepat (search)
     */
    public function indexPublic(Request $request)
    {
        // Self-healing: pastikan schema tabel & data katalog produk terinisialisasi otomatis di Vercel / serverless
        if (!\Illuminate\Support\Facades\Schema::hasTable('product_categories')) {
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'ProductSeeder', '--force' => true]);
        } elseif (ProductCategory::count() === 0) {
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'ProductSeeder', '--force' => true]);
        }

        $selectedCategory = $request->query('category', 'all');
        $search = trim($request->query('search', ''));

        $categories = ProductCategory::where('is_active', true)
            ->withCount(['products' => function ($query) {
                $query->where('status', 'published');
            }])
            ->get();

        // Ambil kolom publik saja (TANPA kolom 'price' di level SQL) untuk privasi penuh B2B
        // sekaligus mencegah kebocoran nominal harga di View Source / Inspect Element
        $products = Product::select([
                'id',
                'category_id',
                'sku',
                'name',
                'slug',
                'badge_primary',
                'badge_secondary',
                'short_description',
                'description',
                'min_order_quantity',
                'is_rfq_only',
                'is_featured',
                'status',
                'image',
                'specifications',
                'created_at',
            ])
            ->with('category:id,name,slug')
            ->where('status', 'published')
            ->orderBy('is_featured', 'desc')
            ->latest()
            ->get();

        return view('product', compact('products', 'categories', 'selectedCategory', 'search'));
    }

    /**
     * Halaman manajemen produk di Dashboard Admin
     */
    public function index()
    {
        return view('admin.product.index');
    }
}
