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
    return view('public.home');
})->name('home');

Route::get('/home', function () {
    return view('public.home');
});

Route::get('/about', function () {
    return view('public.about');
})->name('about');

Route::get('/sitemap.xml', function () {
    $staticPaths = [
        '/', '/about', '/vision-mission', '/product', '/solution',
        '/application', '/application/manufacturing', '/application/automotive',
        '/application/pharma', '/application/bms', '/application/packaging',
        '/projects', '/simulator', '/contact',
    ];
    $solutionSlugs = \App\Models\Solution::where('show_in_navbar', true)->pluck('slug');
    $urls = collect($staticPaths)->map(fn ($p) => url($p));
    foreach ($solutionSlugs as $slug) {
        $urls->push(url('/solution/' . $slug));
    }

    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
    foreach ($urls->unique() as $u) {
        $xml .= "  <url><loc>" . e($u) . "</loc><changefreq>weekly</changefreq></url>\n";
    }
    $xml .= "</urlset>";

    return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
})->name('sitemap');

Route::get('/solution', function () {
    return view('public.solution');
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
    return view('public.vision-mission');
})->name('vision-mission');

Route::get('/application', function () {
    return view('public.application');
})->name('application');

// Dedicated Operational Domain Pages
Route::get('/application/manufacturing', function () {
    return view('public.applications.manufacturing');
})->name('application.manufacturing');

Route::get('/application/automotive', function () {
    return view('public.applications.automotive');
})->name('application.automotive');

Route::get('/application/pharma', function () {
    return view('public.applications.pharma');
})->name('application.pharma');

Route::get('/application/bms', function () {
    return view('public.applications.bms');
})->name('application.bms');

Route::get('/application/packaging', function () {
    return view('public.applications.packaging');
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
    $validDomains = ['manufacturing', 'automotive', 'pharma', 'bms', 'logistics', 'enpi'];
    if (!in_array($domain, $validDomains, true)) {
        $domain = 'manufacturing';
    }
    if ($domain === 'enpi') {
        $domain = 'pharma';
    }
    return view('public.simulator', ['activeDomain' => $domain]);
})->name('simulator.show');

Route::get('/projects', function () {
    return view('public.projects');
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

// Solution Sub-Pages (Dynamically Powered by Admin Solutions Manager)
Route::get('/solution/{solution:slug}', [\App\Http\Controllers\SolutionController::class, 'showPublic'])
    ->name('solutions.public.show');

Route::get('/plc-progamming', function () {
    return app(\App\Http\Controllers\SolutionController::class)->showBySlug('plc-progamming');
})->name('plc-progamming');

Route::get('/inspection', function () {
    return app(\App\Http\Controllers\SolutionController::class)->showBySlug('inspection');
})->name('inspection');

Route::get('/software', function () {
    return app(\App\Http\Controllers\SolutionController::class)->showBySlug('software');
})->name('software');

Route::get('/monitoring', function () {
    return redirect()->route('software');
})->name('monitoring');

Route::get('/intergrator', function () {
    return app(\App\Http\Controllers\SolutionController::class)->showBySlug('intergrator');
})->name('intergrator');

Route::get('/laser-marking', function () {
    return app(\App\Http\Controllers\SolutionController::class)->showBySlug('laser-marking');
})->name('laser-marking');

Route::get('/strapping', function () {
    return app(\App\Http\Controllers\SolutionController::class)->showBySlug('strapping');
})->name('strapping');

// ==========================
// Authenticated App & Settings
// ==========================

Route::get('dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// API Endpoint: Lead Simulator, EIS Excel Workbook Export & Public CMS Live Version Check (registered with & without /api prefix for Vercel serverless)
Route::post('/simulation-lead', [\App\Http\Controllers\Admin\SimulationLeadController::class, 'storePublic'])->name('simulation-lead');
Route::post('/api/simulation-lead', [\App\Http\Controllers\Admin\SimulationLeadController::class, 'storePublic'])->name('api.simulation-lead');
Route::post('/simulator/export-eis-excel', [\App\Http\Controllers\Admin\SimulationLeadController::class, 'exportEisExcel'])->name('simulator.export-eis-excel');

$cmsVersionHandler = function () {
    $parts = [
        \App\Models\Product::count() . ':' . (\App\Models\Product::max('updated_at') ?? ''),
        \App\Models\ProductCategory::count() . ':' . (\App\Models\ProductCategory::max('updated_at') ?? ''),
        \App\Models\Solution::count() . ':' . (\App\Models\Solution::max('updated_at') ?? ''),
        \App\Models\Project::count() . ':' . (\App\Models\Project::max('updated_at') ?? ''),
        \App\Models\SiteSetting::count() . ':' . (\App\Models\SiteSetting::max('updated_at') ?? ''),
    ];

    return response()->json([
        'version' => md5(implode('|', $parts)),
        'timestamp' => now()->toIso8601String(),
    ])->header('Cache-Control', 'no-store, no-cache, must-revalidate');
};
Route::get('/cms-version', $cmsVersionHandler)->name('api.cms-version');
Route::get('/api/cms-version', $cmsVersionHandler);
Route::post('/checkout/{order:uuid}/log-whatsapp-click', [\App\Http\Controllers\CheckoutController::class, 'logWhatsAppClick'])->name('checkout.log-whatsapp-click');

// Admin Console Area (PT Global Aspect Technology)
Route::redirect('/admin', '/admin/dashboard');

if (!function_exists('buildAdminTrafficSeries')) {
    function buildAdminTrafficSeries($todayVisitors, $totalVisitors, $totalLeads, $totalInquiries, $totalOrders)
    {
        $today = today();
        $dayNames = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

        // Pre-aggregate 60 days of REAL visitor logs in 1 single fast SQL query (no fake random numbers!)
        $startDate60 = $today->copy()->subDays(59)->startOfDay();
        $dailyAgg = \App\Models\VisitorLog::where('created_at', '>=', $startDate60)
            ->selectRaw('DATE(created_at) as d, COUNT(*) as total_hits, COUNT(DISTINCT ip_address) as unique_ips')
            ->groupBy('d')
            ->get()
            ->keyBy('d');

        // 1. Daily series for past 60 days strictly ending TODAY (100% Real DB Data)
        $dailySeries = [];
        for ($i = 59; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $dayOfWeek = (int) $date->format('w');
            $isToday = ($i === 0);

            $row = $dailyAgg->get($dateStr);
            $report = $isToday ? (int) $todayVisitors : (int) ($row->total_hits ?? 0);
            $unique = (int) ($row->unique_ips ?? 0);

            $dailySeries[] = [
                'date' => $dateStr,
                'label' => (string) $date->format('j'),
                'full_label' => $dayNames[$dayOfWeek] . ', ' . $date->format('j M Y'),
                'day_name' => $dayNames[$dayOfWeek],
                'day' => (int) $date->format('j'),
                'is_today' => $isToday,
                'report' => $report,
                'noReport' => $unique,
            ];
        }

        // 2. Weekly series for past 12 weeks strictly ending at CURRENT WEEK (100% Real DB Data)
        $weeklySeries = [];
        for ($w = 11; $w >= 0; $w--) {
            $startOfWeek = $today->copy()->subWeeks($w)->startOfWeek();
            $endOfWeek = $w === 0 ? $today->copy() : $startOfWeek->copy()->endOfWeek();
            $wRange = [$startOfWeek, $endOfWeek->copy()->endOfDay()];
            $wCount = \App\Models\VisitorLog::whereBetween('created_at', $wRange)->count();
            $wUnique = \App\Models\VisitorLog::whereBetween('created_at', $wRange)->distinct('ip_address')->count('ip_address');
            $weeklySeries[] = [
                'date' => $startOfWeek->format('Y-m-d'),
                'label' => 'Mgg ' . (12 - $w),
                'full_label' => $startOfWeek->format('j M') . ' - ' . $endOfWeek->format('j M Y'),
                'is_today' => ($w === 0),
                'report' => (int) $wCount,
                'noReport' => (int) $wUnique,
            ];
        }

        // 3. Monthly series for past 12 months strictly ending at CURRENT MONTH (100% Real DB Data)
        $monthlySeries = [];
        $monthNames = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        for ($m = 11; $m >= 0; $m--) {
            $mDate = $today->copy()->subMonths($m);
            $mYear = (int) $mDate->format('Y');
            $mMonth = (int) $mDate->format('n');
            $mCount = \App\Models\VisitorLog::whereYear('created_at', $mYear)
                ->whereMonth('created_at', $mMonth)
                ->count();
            $mUnique = \App\Models\VisitorLog::whereYear('created_at', $mYear)
                ->whereMonth('created_at', $mMonth)
                ->distinct('ip_address')
                ->count('ip_address');
            $monthlySeries[] = [
                'date' => $mDate->format('Y-m'),
                'label' => $monthNames[$mMonth],
                'full_label' => $monthNames[$mMonth] . ' ' . $mYear,
                'is_today' => ($m === 0),
                'report' => (int) $mCount,
                'noReport' => (int) $mUnique,
            ];
        }

        // 4. Yearly series for past 4 years strictly ending at CURRENT YEAR (100% Real DB Data)
        $yearlySeries = [];
        $currYear = (int) $today->format('Y');
        for ($y = 3; $y >= 0; $y--) {
            $yr = $currYear - $y;
            $yCount = \App\Models\VisitorLog::whereYear('created_at', $yr)->count();
            $yUnique = \App\Models\VisitorLog::whereYear('created_at', $yr)->distinct('ip_address')->count('ip_address');
            $yearlySeries[] = [
                'date' => (string) $yr,
                'label' => (string) $yr,
                'full_label' => 'Tahun ' . $yr,
                'is_today' => ($y === 0),
                'report' => (int) $yCount,
                'noReport' => (int) $yUnique,
            ];
        }

        return [
            'today_date' => $today->format('Y-m-d'),
            'daily' => $dailySeries,
            'weekly' => $weeklySeries,
            'monthly' => $monthlySeries,
            'yearly' => $yearlySeries,
        ];
    }
}

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $orders = \App\Models\Order::latest()->take(8)->get();
        $totalOrders = \App\Models\Order::count();
        $totalRevenue = \App\Models\Order::sum('grand_total');
        $totalProducts = \App\Models\Product::count();

        // Data Analitik & CRM Terpadu
        $totalVisitorsToday = \App\Models\VisitorLog::whereDate('created_at', today())->count();
        $totalVisitorsAll = \App\Models\VisitorLog::count();
        $recentVisitors = \App\Models\VisitorLog::latest()->take(6)->get();

        $totalSimulationLeads = \App\Models\SimulationLead::count();
        $newSimulationLeads = \App\Models\SimulationLead::where('status', 'new')->count();
        $recentLeads = \App\Models\SimulationLead::latest()->take(6)->get();

        $totalInquiries = \App\Models\ContactMessage::count();
        $unreadInquiries = \App\Models\ContactMessage::where('status', 'unread')->count();

        $totalProjects = \App\Models\Project::count();
        $shownProjects = \App\Models\Project::where('is_featured', true)->count();
        $totalSolutions = \App\Models\Solution::count();
        $shownSolutions = \App\Models\Solution::where('show_in_navbar', true)->count();
        $publishedProducts = \App\Models\Product::where('status', 'published')->count();

        $orderStatusLabels = [
            'awaiting_po' => 'Menunggu PO',
            'po_submitted' => 'PO Terkirim',
            'confirmed' => 'Dikonfirmasi',
            'processing' => 'Diproses',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        $leadDomainLabels = [
            'manufacturing' => 'Manufacturing & FMCG',
            'automotive' => 'Automotive Assembly',
            'pharma' => 'Pharma & Vision',
            'bms' => 'BMS & Telemetri',
            'logistics' => 'Logistics & Conveyor',
            'enpi' => 'EnPI Energy SCADA',
        ];

        $recentOrdersData = \App\Models\Order::withCount('items')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($o) use ($orderStatusLabels) {
                return [
                    'id' => $o->id,
                    'order_number' => $o->invoice_number ?: ('ORD-' . $o->id),
                    'company_name' => $o->company_name ?: ($o->pic_name ?: 'Klien B2B'),
                    'customer_name' => $o->pic_name ?: '-',
                    'status' => $o->status ?: 'awaiting_po',
                    'status_label' => $orderStatusLabels[$o->status] ?? ucfirst(str_replace('_', ' ', (string) $o->status)),
                    'grand_total' => (float) $o->grand_total,
                    'grand_total_formatted' => 'Rp ' . number_format((float) $o->grand_total, 0, ',', '.'),
                    'items_count' => (int) ($o->items_count ?? 0),
                    'date_formatted' => $o->created_at ? $o->created_at->format('d M Y, H:i') : '-',
                    'time_ago' => $o->created_at ? $o->created_at->diffForHumans() : 'Baru saja',
                    'detail_url' => route('admin.orders.show', $o->uuid),
                    'pdf_url' => route('admin.orders.pdf', $o->uuid),
                ];
            })->values()->all();

        $recentLeadsData = $recentLeads->map(function ($l) use ($leadDomainLabels) {
            $domainKey = strtolower((string) ($l->domain ?: 'manufacturing'));
            return [
                'id' => $l->id,
                'company_name' => $l->company_name ?: ($l->pic_name ?: 'Prospek Industri'),
                'industry_type' => $leadDomainLabels[$domainKey] ?? ucfirst($domainKey),
                'status' => $l->status ?: 'new',
                'time_ago' => $l->created_at ? $l->created_at->diffForHumans() : 'Baru saja',
            ];
        })->values()->all();

        $formatShort = function ($val) {
            if ($val >= 1000000000) return 'Rp ' . number_format($val / 1000000000, 1, ',', '.') . ' M';
            if ($val >= 1000000) return 'Rp ' . number_format($val / 1000000, 1, ',', '.') . ' Jt';
            return 'Rp ' . number_format($val, 0, ',', '.');
        };

        $poSubmittedCount = \App\Models\Order::where('status', 'po_submitted')->count();
        $poSubmittedTotal = (float) \App\Models\Order::where('status', 'po_submitted')->sum('grand_total');

        $awaitingPoCount = \App\Models\Order::where('status', 'awaiting_po')->count();
        $awaitingPoTotal = (float) \App\Models\Order::where('status', 'awaiting_po')->sum('grand_total');

        $inspectionTotal = (float) \App\Models\OrderItem::where(function ($q) {
            $q->where('product_name', 'like', '%Inspection%')
                ->orWhere('product_name', 'like', '%Pengukuran%')
                ->orWhere('product_name', 'like', '%Kamera%');
        })->sum('line_total');

        $automationTotal = (float) \App\Models\OrderItem::where(function ($q) {
            $q->where('product_name', 'like', '%Panel%')
                ->orWhere('product_name', 'like', '%Otomasi%')
                ->orWhere('product_name', 'like', '%Kontrol%');
        })->sum('line_total');

        $poSubmittedPct = $totalRevenue > 0 ? round(($poSubmittedTotal / $totalRevenue) * 100, 1) : 73.4;

        $orderStats = [
            'total_orders' => $totalOrders,
            'total_revenue' => (float) $totalRevenue,
            'revenue_formatted' => $formatShort($totalRevenue),
            'full_revenue_formatted' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'),
            'po_submitted_count' => $poSubmittedCount,
            'po_submitted_total' => $poSubmittedTotal,
            'po_submitted_formatted' => $formatShort($poSubmittedTotal),
            'awaiting_po_count' => $awaitingPoCount,
            'awaiting_po_total' => $awaitingPoTotal,
            'awaiting_po_formatted' => $formatShort($awaitingPoTotal),
            'inspection_total' => $inspectionTotal,
            'inspection_formatted' => $formatShort($inspectionTotal),
            'automation_total' => $automationTotal,
            'automation_formatted' => $formatShort($automationTotal),
            'po_submitted_pct' => $poSubmittedPct,
            'stroke_offset' => round(351.86 * (1 - ($poSubmittedPct / 100)), 2),
        ];

        $allTrafficSeries = buildAdminTrafficSeries($totalVisitorsToday, $totalVisitorsAll, $totalSimulationLeads, $totalInquiries, $totalOrders);

        return view('admin.dashboard', compact(
            'orders',
            'totalOrders',
            'totalRevenue',
            'totalProducts',
            'publishedProducts',
            'orderStats',
            'allTrafficSeries',
            'totalVisitorsToday',
            'totalVisitorsAll',
            'recentVisitors',
            'totalSimulationLeads',
            'newSimulationLeads',
            'recentLeads',
            'recentLeadsData',
            'recentOrdersData',
            'totalInquiries',
            'unreadInquiries',
            'totalProjects',
            'shownProjects',
            'totalSolutions',
            'shownSolutions'
        ));
    })->name('dashboard');

    // API Real-time Live Traffic & Integrated Telemetry
    Route::get('/api/live-traffic', function () {
        $todayVisitors = \App\Models\VisitorLog::whereDate('created_at', today())->count();
        $totalVisitors = \App\Models\VisitorLog::count();

        // Online visitors in the last 5 minutes (100% real, never faked)
        $onlineNow = \App\Models\VisitorLog::where('created_at', '>=', now()->subMinutes(5))
            ->distinct('ip_address')
            ->count('ip_address');

        $latest = \App\Models\VisitorLog::latest()->first();
        $latestVisit = null;
        if ($latest) {
            $pagePath = parse_url($latest->page_url, PHP_URL_PATH) ?: '/';
            $latestVisit = [
                'id' => $latest->id,
                'ip' => $latest->ip_address,
                'page' => $pagePath,
                'full_url' => $latest->page_url,
                'device' => $latest->device ?? 'Desktop',
                'browser' => $latest->browser ?? 'Browser',
                'platform' => $latest->platform ?? 'OS',
                'time_ago' => $latest->created_at->diffForHumans(),
                'exact_time' => $latest->created_at->format('H:i:s'),
            ];
        }

        // Recent 6 visitors for real-time list
        $recentVisitors = \App\Models\VisitorLog::latest()->take(6)->get()->map(function ($v) {
            return [
                'id' => $v->id,
                'ip' => $v->ip_address,
                'page_url' => $v->page_url,
                'device' => $v->device ?? 'Desktop',
                'browser' => $v->browser ?? 'Browser',
                'platform' => $v->platform ?? 'OS',
                'time_ago' => $v->created_at->diffForHumans(),
            ];
        });

        // Integrated counts across all modules
        $totalLeads = \App\Models\SimulationLead::count();
        $newLeads = \App\Models\SimulationLead::where('status', 'new')->count();
        $totalOrders = \App\Models\Order::count();
        $totalRevenue = (float) \App\Models\Order::sum('grand_total');
        $newOrders = \App\Models\Order::where('status', 'awaiting_po')->count();
        $totalInquiries = \App\Models\ContactMessage::count();
        $unreadInquiries = \App\Models\ContactMessage::where('status', 'unread')->count();
        $totalProducts = \App\Models\Product::count();
        $publishedProducts = \App\Models\Product::where('status', 'published')->count();
        $totalSolutions = \App\Models\Solution::count();
        $shownSolutions = \App\Models\Solution::where('show_in_navbar', true)->count();
        $totalProjects = \App\Models\Project::count();
        $shownProjects = \App\Models\Project::where('is_featured', true)->count();

        $formatShort = function ($val) {
            if ($val >= 1000000000) return 'Rp ' . number_format($val / 1000000000, 1, ',', '.') . ' M';
            if ($val >= 1000000) return 'Rp ' . number_format($val / 1000000, 1, ',', '.') . ' Jt';
            return 'Rp ' . number_format($val, 0, ',', '.');
        };

        $poSubmittedCount = \App\Models\Order::where('status', 'po_submitted')->count();
        $poSubmittedTotal = (float) \App\Models\Order::where('status', 'po_submitted')->sum('grand_total');

        $awaitingPoCount = \App\Models\Order::where('status', 'awaiting_po')->count();
        $awaitingPoTotal = (float) \App\Models\Order::where('status', 'awaiting_po')->sum('grand_total');

        $inspectionTotal = (float) \App\Models\OrderItem::where(function ($q) {
            $q->where('product_name', 'like', '%Inspection%')
                ->orWhere('product_name', 'like', '%Pengukuran%')
                ->orWhere('product_name', 'like', '%Kamera%');
        })->sum('line_total');

        $automationTotal = (float) \App\Models\OrderItem::where(function ($q) {
            $q->where('product_name', 'like', '%Panel%')
                ->orWhere('product_name', 'like', '%Otomasi%')
                ->orWhere('product_name', 'like', '%Kontrol%');
        })->sum('line_total');

        $poSubmittedPct = $totalRevenue > 0 ? round(($poSubmittedTotal / $totalRevenue) * 100, 1) : 73.4;

        $orderStats = [
            'total_orders' => $totalOrders,
            'total_revenue' => (float) $totalRevenue,
            'revenue_formatted' => $formatShort($totalRevenue),
            'full_revenue_formatted' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'),
            'po_submitted_count' => $poSubmittedCount,
            'po_submitted_total' => $poSubmittedTotal,
            'po_submitted_formatted' => $formatShort($poSubmittedTotal),
            'awaiting_po_count' => $awaitingPoCount,
            'awaiting_po_total' => $awaitingPoTotal,
            'awaiting_po_formatted' => $formatShort($awaitingPoTotal),
            'inspection_total' => $inspectionTotal,
            'inspection_formatted' => $formatShort($inspectionTotal),
            'automation_total' => $automationTotal,
            'automation_formatted' => $formatShort($automationTotal),
            'po_submitted_pct' => $poSubmittedPct,
            'stroke_offset' => round(351.86 * (1 - ($poSubmittedPct / 100)), 2),
        ];

        $trafficSeries = buildAdminTrafficSeries($todayVisitors, $totalVisitors, $totalLeads, $totalInquiries, $totalOrders);

        $orderStatusLabels = [
            'awaiting_po' => 'Menunggu PO',
            'po_submitted' => 'PO Terkirim',
            'confirmed' => 'Dikonfirmasi',
            'processing' => 'Diproses',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        $leadDomainLabels = [
            'manufacturing' => 'Manufacturing & FMCG',
            'automotive' => 'Automotive Assembly',
            'pharma' => 'Pharma & Vision',
            'bms' => 'BMS & Telemetri',
            'logistics' => 'Logistics & Conveyor',
            'enpi' => 'EnPI Energy SCADA',
        ];

        $recentOrders = \App\Models\Order::withCount('items')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($o) use ($orderStatusLabels) {
                return [
                    'id' => $o->id,
                    'order_number' => $o->invoice_number ?: ('ORD-' . $o->id),
                    'company_name' => $o->company_name ?: ($o->pic_name ?: 'Klien B2B'),
                    'customer_name' => $o->pic_name ?: '-',
                    'status' => $o->status ?: 'awaiting_po',
                    'status_label' => $orderStatusLabels[$o->status] ?? ucfirst(str_replace('_', ' ', (string) $o->status)),
                    'grand_total' => (float) $o->grand_total,
                    'grand_total_formatted' => 'Rp ' . number_format((float) $o->grand_total, 0, ',', '.'),
                    'items_count' => (int) ($o->items_count ?? 0),
                    'date_formatted' => $o->created_at ? $o->created_at->format('d M Y, H:i') : '-',
                    'time_ago' => $o->created_at ? $o->created_at->diffForHumans() : 'Baru saja',
                    'detail_url' => route('admin.orders.show', $o->uuid),
                    'pdf_url' => route('admin.orders.pdf', $o->uuid),
                ];
            })->values();

        $recentLeads = \App\Models\SimulationLead::latest()->take(8)->get()->map(function ($l) use ($leadDomainLabels) {
            $domainKey = strtolower((string) ($l->domain ?: 'manufacturing'));
            return [
                'id' => $l->id,
                'company_name' => $l->company_name ?: ($l->pic_name ?: 'Prospek Industri'),
                'industry_type' => $leadDomainLabels[$domainKey] ?? ucfirst($domainKey),
                'status' => $l->status ?: 'new',
                'time_ago' => $l->created_at ? $l->created_at->diffForHumans() : 'Baru saja',
            ];
        })->values();

        return response()->json([
            'today' => $todayVisitors,
            'total' => $totalVisitors,
            'online_now' => $onlineNow,
            'latest_visit' => $latestVisit,
            'recent_visitors' => $recentVisitors,
            'recent_orders' => $recentOrders,
            'recent_leads' => $recentLeads,
            'total_leads' => $totalLeads,
            'new_leads' => $newLeads,
            'total_orders' => $totalOrders,
            'new_orders' => $newOrders,
            'total_inquiries' => $totalInquiries,
            'unread_inquiries' => $unreadInquiries,
            'total_products' => $totalProducts,
            'published_products' => $publishedProducts,
            'total_solutions' => $totalSolutions,
            'shown_solutions' => $shownSolutions,
            'total_projects' => $totalProjects,
            'shown_projects' => $shownProjects,
            'active_channels' => \App\Models\SiteSetting::activeChannelsCount(),
            'order_stats' => $orderStats,
            'series' => $trafficSeries,
            'today_date' => today()->format('Y-m-d'),
            'timestamp' => now()->format('Y-m-d H:i:s'),
        ]);
    })->name('api.live-traffic');

    // 1. Leads Simulator
    Route::get('/leads', [\App\Http\Controllers\Admin\SimulationLeadController::class, 'index'])->name('leads.index');
    Route::get('/leads/export', [\App\Http\Controllers\Admin\SimulationLeadController::class, 'exportCsv'])->name('leads.export');
    Route::patch('/leads/{lead}/status', [\App\Http\Controllers\Admin\SimulationLeadController::class, 'updateStatus'])->name('leads.status');
    Route::delete('/leads/{lead}', [\App\Http\Controllers\Admin\SimulationLeadController::class, 'destroy'])->name('leads.destroy');

    // 2. Products Catalog & Categories CRUD
    Route::get('/product', [\App\Http\Controllers\Admin\ProductAdminController::class, 'index'])->name('product.index');
    Route::post('/product', [\App\Http\Controllers\Admin\ProductAdminController::class, 'store'])->name('product.store');
    Route::put('/product/{product}', [\App\Http\Controllers\Admin\ProductAdminController::class, 'update'])->name('product.update');
    Route::patch('/product/{product}/status', [\App\Http\Controllers\Admin\ProductAdminController::class, 'toggleStatus'])->name('product.toggle-status');
    Route::patch('/product/{product}/featured', [\App\Http\Controllers\Admin\ProductAdminController::class, 'toggleFeatured'])->name('product.toggle-featured');
    Route::delete('/product/{product}', [\App\Http\Controllers\Admin\ProductAdminController::class, 'destroy'])->name('product.destroy');

    Route::post('/product-categories', [\App\Http\Controllers\Admin\ProductAdminController::class, 'storeCategory'])->name('product-categories.store');
    Route::put('/product-categories/{category}', [\App\Http\Controllers\Admin\ProductAdminController::class, 'updateCategory'])->name('product-categories.update');
    Route::patch('/product-categories/{category}/toggle', [\App\Http\Controllers\Admin\ProductAdminController::class, 'toggleCategory'])->name('product-categories.toggle');
    Route::delete('/product-categories/{category}', [\App\Http\Controllers\Admin\ProductAdminController::class, 'destroyCategory'])->name('product-categories.destroy');

    // 3. Orders & WhatsApp Log
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderAdminController::class, 'index'])->name('orders.index');
    Route::get('/orders/export', [\App\Http\Controllers\Admin\OrderAdminController::class, 'exportCsv'])->name('orders.export');
    Route::get('/orders/{order}', [\App\Http\Controllers\Admin\OrderAdminController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderAdminController::class, 'updateStatus'])->name('orders.status');
    Route::get('/orders/{order}/pdf', [\App\Http\Controllers\Admin\OrderAdminController::class, 'downloadQuotePdf'])->name('orders.pdf');
    Route::get('/orders/{order}/po-file', [\App\Http\Controllers\Admin\OrderAdminController::class, 'downloadPoDocument'])->name('orders.po-file');
    Route::post('/orders/{order}/log-wa', [\App\Http\Controllers\Admin\OrderAdminController::class, 'logWhatsApp'])->name('orders.log-wa');
    Route::delete('/orders/{order}', [\App\Http\Controllers\Admin\OrderAdminController::class, 'destroy'])->name('orders.destroy');

    // 4. Solutions CRUD
    Route::get('/solutions', [\App\Http\Controllers\SolutionController::class, 'index'])->name('solutions.index');
    Route::post('/solutions', [\App\Http\Controllers\SolutionController::class, 'store'])->name('solutions.store');
    Route::put('/solutions/{solution}', [\App\Http\Controllers\SolutionController::class, 'update'])->name('solutions.update');
    Route::patch('/solutions/{solution}/toggle-navbar', [\App\Http\Controllers\SolutionController::class, 'toggleNavbar'])->name('solutions.toggle-navbar');
    Route::patch('/solutions/{solution}/reorder', [\App\Http\Controllers\SolutionController::class, 'reorder'])->name('solutions.reorder');
    Route::delete('/solutions/{solution}', [\App\Http\Controllers\SolutionController::class, 'destroy'])->name('solutions.destroy');

    // 5. Projects CRUD
    Route::get('/projects', [\App\Http\Controllers\Admin\ProjectAdminController::class, 'index'])->name('projects.index');
    Route::post('/projects', [\App\Http\Controllers\Admin\ProjectAdminController::class, 'store'])->name('projects.store');
    Route::put('/projects/{project}', [\App\Http\Controllers\Admin\ProjectAdminController::class, 'update'])->name('projects.update');
    Route::patch('/projects/{project}/toggle-status', [\App\Http\Controllers\Admin\ProjectAdminController::class, 'toggleStatus'])->name('projects.toggle-status');
    Route::delete('/projects/{project}', [\App\Http\Controllers\Admin\ProjectAdminController::class, 'destroy'])->name('projects.destroy');

    // 6. Contact Inquiries
    Route::get('/contacts', [\App\Http\Controllers\Admin\ContactAdminController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/export', [\App\Http\Controllers\Admin\ContactAdminController::class, 'exportCsv'])->name('contacts.export');
    Route::patch('/contacts/{contact}/status', [\App\Http\Controllers\Admin\ContactAdminController::class, 'updateStatus'])->name('contacts.status');
    Route::patch('/contacts/{contact}/read', [\App\Http\Controllers\Admin\ContactAdminController::class, 'markAsRead'])->name('contacts.read');
    Route::patch('/contacts/{contact}/contacted', [\App\Http\Controllers\Admin\ContactAdminController::class, 'markAsContacted'])->name('contacts.contacted');
    Route::patch('/contacts/mark-all-read', [\App\Http\Controllers\Admin\ContactAdminController::class, 'markAllRead'])->name('contacts.mark-all-read');
    Route::delete('/contacts/{contact}', [\App\Http\Controllers\Admin\ContactAdminController::class, 'destroy'])->name('contacts.destroy');

    // 7. WhatsApp Gateway, Webhook & Social Media Manager
    Route::get('/integrations', [\App\Http\Controllers\Admin\IntegrationAdminController::class, 'index'])->name('integrations.index');
    Route::put('/integrations/whatsapp', [\App\Http\Controllers\Admin\IntegrationAdminController::class, 'updateWhatsApp'])->name('integrations.whatsapp.update');
    Route::put('/integrations/social', [\App\Http\Controllers\Admin\IntegrationAdminController::class, 'updateSocial'])->name('integrations.social.update');
    Route::patch('/integrations/social/toggle', [\App\Http\Controllers\Admin\IntegrationAdminController::class, 'toggleSocialVisibility'])->name('integrations.social.toggle');
    Route::get('/integrations/whatsapp/status', [\App\Http\Controllers\Admin\IntegrationAdminController::class, 'gatewayStatus'])->name('integrations.whatsapp.status');
    Route::post('/integrations/whatsapp/start', [\App\Http\Controllers\Admin\IntegrationAdminController::class, 'gatewayStart'])->name('integrations.whatsapp.start');
    Route::post('/integrations/whatsapp/logout', [\App\Http\Controllers\Admin\IntegrationAdminController::class, 'gatewayLogout'])->name('integrations.whatsapp.logout');
    Route::post('/integrations/whatsapp/test', [\App\Http\Controllers\Admin\IntegrationAdminController::class, 'testWhatsApp'])->name('integrations.whatsapp.test');

    // 8. Admin Profile, Identity Verification, Strict Security & Multi-Admin
    Route::put('/profile/verify', [\App\Http\Controllers\Admin\AdminProfileController::class, 'verify'])->name('profile.verify');
    Route::put('/profile/settings', [\App\Http\Controllers\Admin\AdminProfileController::class, 'updateSettings'])->name('profile.settings');
    Route::post('/profile/2fa/setup', [\App\Http\Controllers\Admin\AdminProfileController::class, 'setupTwoFactor'])->name('profile.2fa.setup');
    Route::post('/profile/2fa/confirm', [\App\Http\Controllers\Admin\AdminProfileController::class, 'confirmTwoFactor'])->name('profile.2fa.confirm');
    Route::delete('/profile/2fa', [\App\Http\Controllers\Admin\AdminProfileController::class, 'disableTwoFactor'])->name('profile.2fa.disable');
    Route::put('/profile/idle-timeout', [\App\Http\Controllers\Admin\AdminProfileController::class, 'updateIdleTimeout'])->name('profile.idle-timeout');
    Route::post('/profile/heartbeat', [\App\Http\Controllers\Admin\AdminProfileController::class, 'heartbeat'])->name('profile.heartbeat');
    Route::post('/profile/sessions/revoke', [\App\Http\Controllers\Admin\AdminProfileController::class, 'revokeOtherSessions'])->name('profile.sessions.revoke');

    Route::post('/admins', [\App\Http\Controllers\Admin\AdminProfileController::class, 'storeAdmin'])->name('admins.store');
    Route::patch('/admins/{user}/toggle', [\App\Http\Controllers\Admin\AdminProfileController::class, 'toggleAdminRole'])->name('admins.toggle');
    Route::put('/admins/{user}/password', [\App\Http\Controllers\Admin\AdminProfileController::class, 'resetAdminPassword'])->name('admins.reset-password');
    Route::delete('/admins/{user}', [\App\Http\Controllers\Admin\AdminProfileController::class, 'destroyAdmin'])->name('admins.destroy');
});

require __DIR__ . '/auth.php';
