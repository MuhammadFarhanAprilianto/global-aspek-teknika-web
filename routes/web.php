<?php

use App\Http\Controllers\CheckoutController;
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

Route::get('/product', [ProductController::class, 'indexPublic'])
    ->middleware('throttle:60,1')
    ->name('product');

// B2B Checkout, Proforma Invoice & PO Submission (Protected via Signed URLs)
Route::post('/checkout/initiate', [CheckoutController::class, 'initiate'])
    ->middleware('throttle:15,1')
    ->name('checkout.initiate');

Route::get('/checkout/{order:uuid}', [CheckoutController::class, 'show'])
    ->middleware(['signed', 'throttle:60,1'])
    ->name('checkout.show');

Route::post('/checkout/{order:uuid}/submit-po', [CheckoutController::class, 'submitPo'])
    ->middleware(['signed', 'throttle:10,1'])
    ->name('checkout.submit-po');

Route::get('/checkout/{order:uuid}/pdf/{filename}', [CheckoutController::class, 'downloadQuotePdf'])
    ->where('filename', '[A-Za-z0-9_\-\.]+\.pdf')
    ->middleware(['signed', 'throttle:60,1'])
    ->name('checkout.quote-pdf');

Route::get('/checkout/{order:uuid}/po-file/{filename}', [CheckoutController::class, 'downloadPoDocument'])
    ->where('filename', '[A-Za-z0-9_\-\.]+')
    ->middleware(['signed', 'throttle:30,1'])
    ->name('checkout.po-file');

Route::get('/verify-invoice/{uuid}/{hash}', [CheckoutController::class, 'verify'])
    ->middleware('throttle:30,1')
    ->name('checkout.verify');

// Contact Form
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send']);

// About Us Sub-Pages (Separated Views: Vision & Mission, Applications, Projects)
Route::get('/vision-mission', function () {
    return view('vision-mission');
})->name('vision-mission');

Route::get('/application', function () {
    return view('application');
})->name('application');

// Dedicated Operational Domain Pages
Route::get('/application/manufacturing', function () {
    return view('applications.manufacturing');
})->name('application.manufacturing');

Route::get('/application/automotive', function () {
    return view('applications.automotive');
})->name('application.automotive');

Route::get('/application/pharma', function () {
    return view('applications.pharma');
})->name('application.pharma');

Route::get('/application/bms', function () {
    return view('applications.bms');
})->name('application.bms');

Route::get('/application/packaging', function () {
    return view('applications.packaging');
})->name('application.packaging');

// Aliases for Domain Pages
Route::get('/manufacturing', function () {
    return redirect()->route('application.manufacturing');
});
Route::get('/automotive', function () {
    return redirect()->route('application.automotive');
});
Route::get('/pharma', function () {
    return redirect()->route('application.pharma');
});
Route::get('/bms', function () {
    return redirect()->route('application.bms');
});
Route::get('/smart-bms', function () {
    return redirect()->route('application.bms');
});
Route::get('/packaging', function () {
    return redirect()->route('application.packaging');
});
Route::get('/application/logistics', function () {
    return redirect()->route('application.packaging');
});

Route::get('/simulator/{domain?}', function (?string $domain = 'manufacturing') {
    $validDomains = ['manufacturing', 'automotive', 'pharma', 'bms', 'logistics'];
    if (!in_array($domain, $validDomains, true)) {
        $domain = 'manufacturing';
    }
    return view('simulator', ['activeDomain' => $domain]);
})->name('simulator.show');

Route::get('/projects', function () {
    return view('projects');
})->name('projects');

Route::get('/project', function () {
    return redirect()->route('projects');
});

Route::get('/about/vision-mission', function () {
    return redirect()->route('vision-mission');
});

Route::get('/about/application', function () {
    return redirect()->route('application');
});

Route::get('/about/projects', function () {
    return redirect()->route('projects');
});

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
