<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LeadController as AdminLeadController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\PageContentController as AdminPageContentController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\UserPermissionController as AdminUserPermissionController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ContactLeadController;
use App\Http\Controllers\InvestorPackController;
use App\Http\Controllers\LandListingController;
use App\Http\Controllers\SavedPropertyController;
use App\Http\Controllers\SitemapController;
use App\Models\LandListing;
use App\Models\Property;
use App\Models\User;
use App\Services\SeoService;
use App\Support\SiteContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $availableProperties = Property::query()->where('status', 'available');
    $currentUser = Auth::user();
    $savedPropertyIds = $currentUser instanceof User
        ? $currentUser->savedProperties()->pluck('properties.id')->all()
        : [];

    return view('pages.home', [
        'featured' => (clone $availableProperties)
            ->with('agent')
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
        'savedPropertyIds' => $savedPropertyIds,
        'heroTitle' => SiteContent::get('home.hero_title', 'Find, filter, and close Nairobi properties with the speed of modern SaaS.'),
        'heroSubtitle' => SiteContent::get('home.hero_subtitle', 'LuxeNest Kenya blends instant search, concierge-grade guidance, and data-backed pricing for buyers, renters, and sellers across Nairobi.'),
        'seo' => SeoService::forPage(
            'Nairobi Real Estate Platform',
            'Discover premium Nairobi properties for sale and rent with investor-friendly insights, fast lead response, and modern filtering.'
        ),
    ]);
})->name('home');

Route::get('/buy', function () {
    $currentUser = Auth::user();
    $savedPropertyIds = $currentUser instanceof User
        ? $currentUser->savedProperties()->pluck('properties.id')->all()
        : [];

    $saleBaseQuery = Property::query()->where('status', 'available')->where('type', 'sale');

    $featuredForSale = (clone $saleBaseQuery)
        ->with('agent')
        ->latest()
        ->take(9)
        ->get();

    $landProperties = LandListing::query()
        ->with('agent')
        ->where('status', 'available')
        ->orderByDesc('featured')
        ->latest()
        ->take(6)
        ->get();

    $commercialProperties = (clone $saleBaseQuery)
        ->where(function ($query): void {
            $query->where('title', 'like', '%commercial%')
                ->orWhere('title', 'like', '%office%')
                ->orWhere('title', 'like', '%retail%')
                ->orWhere('description', 'like', '%commercial%')
                ->orWhere('description', 'like', '%yield%');
        })
        ->take(6)
        ->get();

    $primeNeighborhoods = (clone $saleBaseQuery)
        ->selectRaw('neighborhood, COUNT(*) as listings_count')
        ->whereNotNull('neighborhood')
        ->groupBy('neighborhood')
        ->orderByDesc('listings_count')
        ->take(6)
        ->get();

    return view('pages.buy', [
        'properties' => $featuredForSale,
        'savedPropertyIds' => $savedPropertyIds,
        'landProperties' => $landProperties,
        'commercialProperties' => $commercialProperties,
        'primeNeighborhoods' => $primeNeighborhoods,
        'saleCount' => (clone $saleBaseQuery)->count(),
        'landCount' => LandListing::query()->where('status', 'available')->count(),
        'avgSalePrice' => (float) ((clone $saleBaseQuery)->avg('price') ?? 0),
        'seo' => SeoService::forPage(
            'Buy Property in Nairobi',
            'Explore residential, land, and commercial real estate opportunities in Nairobi with investor-ready analytics and curated listings.'
        ),
    ]);
})->name('buy');

Route::get('/rent', function () {
    return redirect()->route('properties.index', ['type' => 'rent']);
})->name('rent');
Route::get('/buy/investor-pack/brief', [InvestorPackController::class, 'brief'])->name('buy.investor-pack.brief');
Route::post('/buy/investor-pack/request', [InvestorPackController::class, 'requestPack'])->name('buy.investor-pack.request');

Route::view('/sell', 'pages.sell')->name('sell');
Route::get('/about-us', function () {
    return view('pages.about', [
        'aboutIntro' => SiteContent::get('about.intro', 'We are a Nairobi-based, product-led real estate company focused on one mission: making high-value property decisions simple, transparent, and fast.'),
        'aboutBody' => SiteContent::get('about.body', 'Our platform combines modern UX with local data intelligence so clients can move from search to signed deal without friction. Every workflow is designed for conversion: discovery, qualification, scheduling, and lead follow-up.'),
        'seo' => SeoService::forPage(
            'About LuxeNest Kenya',
            'Learn about LuxeNest Kenya, a Nairobi real estate platform built for premium listings, investor conversion, and transparent property decisions.'
        ),
    ]);
})->name('about');
Route::post('/about-us/contact', [ContactLeadController::class, 'store'])->name('about.contact.store');
Route::view('/terms-of-service', 'pages.legal.terms')->name('legal.terms');
Route::view('/privacy-policy', 'pages.legal.privacy')->name('legal.privacy');
Route::view('/cookie-preferences', 'pages.legal.cookies')->name('legal.cookies');
Route::view('/data-protection-kenya', 'pages.legal.data-protection')->name('legal.data-protection');

Route::get('/properties', function () {
    return view('properties.index', [
        'seo' => SeoService::forPage(
            'Nairobi Property Listings',
            'Browse available Nairobi properties with real-time filters for price, location, amenities, and investment fit.'
        ),
    ]);
})->name('properties.index');
Route::get('/properties/{property:slug}', fn (Property $property) => view('properties.show', [
    'property' => $property,
    'seo' => SeoService::forProperty($property),
]))->name('properties.show');
Route::get('/land', [LandListingController::class, 'index'])->name('land.index');
Route::get('/land/{landListing}', [LandListingController::class, 'show'])->name('land.show');
Route::get('/agents/{agent}', [AgentController::class, 'show'])->name('agents.show');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');
Route::get('/robots.txt', function () {
    $robots = "User-agent: *\n";
    $robots .= "Allow: /\n";
    $robots .= 'Sitemap: '.route('sitemap.xml')."\n";

    return response($robots, 200, ['Content-Type' => 'text/plain']);
})->name('robots.txt');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('/saved-properties', [SavedPropertyController::class, 'index'])->name('saved-properties.index');
    Route::post('/saved-properties/{property}/toggle', [SavedPropertyController::class, 'toggle'])->name('saved-properties.toggle');
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

    Route::get('appointments', [AdminAppointmentController::class, 'index'])
        ->middleware('admin.permission:manage_appointments')
        ->name('appointments.index');
    Route::patch('appointments/{appointment}', [AdminAppointmentController::class, 'updateStatus'])
        ->middleware('admin.permission:manage_appointments')
        ->name('appointments.update-status');

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
