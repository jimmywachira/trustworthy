<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LeadController as AdminLeadController;
use App\Http\Controllers\Admin\PageContentController as AdminPageContentController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\UserPermissionController as AdminUserPermissionController;
use App\Models\Property;
use App\Support\SiteContent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $availableProperties = Property::query()->where('status', 'available');

    return view('pages.home', [
        'featured' => (clone $availableProperties)
            ->latest()
            ->take(6)
            ->get(),
        'totalListings' => (clone $availableProperties)->count(),
        'rentListings' => (clone $availableProperties)->where('type', 'rent')->count(),
        'saleListings' => (clone $availableProperties)->where('type', 'sale')->count(),
        'avgSalePrice' => (float) ((clone $availableProperties)->where('type', 'sale')->avg('price') ?? 0),
        'hotNeighborhoods' => (clone $availableProperties)
            ->selectRaw('neighborhood, COUNT(*) as listings_count')
            ->whereNotNull('neighborhood')
            ->groupBy('neighborhood')
            ->orderByDesc('listings_count')
            ->take(6)
            ->get(),
        'testimonials' => [
            [
                'name' => 'Njeri Mwangi',
                'role' => 'Property Investor, Westlands',
                'quote' => 'LuxeNest helped us shortlist serious buyer leads in days, not weeks. The filtering and lead quality are excellent.',
            ],
            [
                'name' => 'Brian Otieno',
                'role' => 'Tenant, Kilimani',
                'quote' => 'The Nairobi neighborhood filters are spot-on. I found a rental that matched my budget and commute in one evening.',
            ],
            [
                'name' => 'Akinyi Wanjiku',
                'role' => 'Home Seller, Karen',
                'quote' => 'From listing to scheduled viewings, the experience felt premium and organized. Exactly what the market needed.',
            ],
        ],
        'heroTitle' => SiteContent::get('home.hero_title', 'Find, filter, and close Nairobi properties with the speed of modern SaaS.'),
        'heroSubtitle' => SiteContent::get('home.hero_subtitle', 'LuxeNest Kenya blends instant search, concierge-grade guidance, and data-backed pricing for buyers, renters, and sellers across Nairobi.'),
    ]);
})->name('home');

Route::get('/buy', function () {
    return redirect()->route('properties.index', ['type' => 'sale']);
})->name('buy');

Route::get('/rent', function () {
    return redirect()->route('properties.index', ['type' => 'rent']);
})->name('rent');

Route::view('/sell', 'pages.sell')->name('sell');
Route::get('/about-us', function () {
    return view('pages.about', [
        'aboutIntro' => SiteContent::get('about.intro', 'We are a Nairobi-based, product-led real estate company focused on one mission: making high-value property decisions simple, transparent, and fast.'),
        'aboutBody' => SiteContent::get('about.body', 'Our platform combines modern UX with local data intelligence so clients can move from search to signed deal without friction. Every workflow is designed for conversion: discovery, qualification, scheduling, and lead follow-up.'),
    ]);
})->name('about');
Route::view('/terms-of-service', 'pages.legal.terms')->name('legal.terms');
Route::view('/privacy-policy', 'pages.legal.privacy')->name('legal.privacy');
Route::view('/cookie-preferences', 'pages.legal.cookies')->name('legal.cookies');
Route::view('/data-protection-kenya', 'pages.legal.data-protection')->name('legal.data-protection');

Route::view('/properties', 'properties.index')->name('properties.index');
Route::get('/properties/{property}', fn (Property $property) => view('properties.show', [
    'property' => $property,
]))->name('properties.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])
        ->middleware('admin.permission:view_dashboard')
        ->name('dashboard');

    Route::get('properties', [AdminPropertyController::class, 'index'])
        ->middleware('admin.permission:manage_properties')
        ->name('properties.index');
    Route::get('properties/create', [AdminPropertyController::class, 'create'])
        ->middleware('admin.permission:manage_properties')
        ->name('properties.create');
    Route::post('properties', [AdminPropertyController::class, 'store'])
        ->middleware('admin.permission:manage_properties')
        ->name('properties.store');
    Route::get('properties/{property}/edit', [AdminPropertyController::class, 'edit'])
        ->middleware('admin.permission:manage_properties')
        ->name('properties.edit');
    Route::put('properties/{property}', [AdminPropertyController::class, 'update'])
        ->middleware('admin.permission:manage_properties')
        ->name('properties.update');
    Route::delete('properties/{property}', [AdminPropertyController::class, 'destroy'])
        ->middleware('admin.permission:delete_properties')
        ->name('properties.destroy');

    Route::get('leads', [AdminLeadController::class, 'index'])
        ->middleware('admin.permission:manage_leads')
        ->name('leads.index');
    Route::delete('leads/{lead}', [AdminLeadController::class, 'destroy'])
        ->middleware('admin.permission:delete_leads')
        ->name('leads.destroy');

    Route::get('pages', [AdminPageContentController::class, 'edit'])
        ->middleware('admin.permission:manage_content')
        ->name('pages.edit');
    Route::put('pages', [AdminPageContentController::class, 'update'])
        ->middleware('admin.permission:manage_content')
        ->name('pages.update');

    Route::get('users', [AdminUserPermissionController::class, 'index'])
        ->middleware('admin.permission:manage_admins')
        ->name('users.index');
    Route::put('users/{user}', [AdminUserPermissionController::class, 'update'])
        ->middleware('admin.permission:manage_admins')
        ->name('users.update');
    Route::delete('users/{user}', [AdminUserPermissionController::class, 'destroy'])
        ->middleware('admin.permission:manage_admins')
        ->name('users.destroy');
});

require __DIR__.'/settings.php';
