<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    // method untuk halaman produk publik
    public function indexPublic()
    {
        return view('product'); // pastikan view 'product.blade.php' ada di resources/views/
    }

    // method untuk admin (CRUD)
    public function index()
    {
        // ini untuk dashboard admin
        return view('admin.product.index');
    }
}
