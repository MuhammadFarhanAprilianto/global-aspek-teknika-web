<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// ==========================
// Public Routes (Company Profile)
// ==========================

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/solution', function () {
    return view('solution');
})->name('solution');

Route::get('/product', [ProductController::class, 'indexPublic'])->name('product');

// Contact Form
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send']);

// Solution Sub-Pages
Route::get('/plc-progamming', function () {
    return view('plc-progamming');
})->name('plc-progamming');

Route::get('/inspection', function () {
    return view('inspection');
})->name('inspection');

Route::get('/monitoring', function () {
    return view('monitoring');
})->name('monitoring');

Route::get('/intergrator', function () {
    return view('intergrator');
})->name('intergrator');

Route::get('/laser-marking', function () {
    return view('laser-marking');
})->name('laser-marking');

Route::get('/strapping', function () {
    return view('strapping');
})->name('strapping');

// ==========================
// Authenticated App & Settings
// ==========================

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Admin Area
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('livewire.admin.dashboard');
    })->name('dashboard');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
});

require __DIR__.'/auth.php';
