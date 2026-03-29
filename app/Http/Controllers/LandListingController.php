<?php

namespace App\Http\Controllers;

use App\Models\LandListing;
use App\Services\SeoService;
use Illuminate\Contracts\View\View;

class LandListingController extends Controller
{
    /**
     * Show professional land listings.
     */
    public function index(): View
    {
        return view('pages.land.index', [
            'landListings' => LandListing::query()
                ->with('agent')
                ->where('status', 'available')
                ->orderByDesc('featured')
                ->latest()
                ->paginate(12),
            'seo' => SeoService::forPage(
                'Land Listings in Nairobi',
                'Browse professional land listings with parcel size, zoning, tenure, title status, and utility readiness details.'
            ),
        ]);
    }

    /**
     * Show land listing detail.
     */
    public function show(LandListing $landListing): View
    {
        return view('pages.land.show', [
            'landListing' => $landListing->load('agent'),
            'seo' => SeoService::forPage(
                $landListing->title.' - Land Listing',
                (string) ($landListing->description ?: 'Professional land listing in '.$landListing->city.', '.$landListing->neighborhood)
            ),
        ]);
    }
}
