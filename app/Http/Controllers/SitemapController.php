<?php

namespace App\Http\Controllers;

use App\Models\LandListing;
use App\Models\Property;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate XML sitemap for indexed pages and published listings.
     */
    public function index(): Response
    {
        $urls = [
            ['loc' => route('home'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route('buy'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('properties.index'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('land.index'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('about'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
        ];

        $propertyUrls = Property::query()
            ->where('status', 'available')
            ->latest('updated_at')
            ->get()
            ->map(fn (Property $property): array => [
                'loc' => route('properties.show', $property),
                'lastmod' => optional($property->updated_at)->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ]);

        $landUrls = LandListing::query()
            ->where('status', 'available')
            ->latest('updated_at')
            ->get()
            ->map(fn (LandListing $land): array => [
                'loc' => route('land.show', $land),
                'lastmod' => optional($land->updated_at)->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ]);

        $xml = view('seo.sitemap', [
            'urls' => collect($urls)->concat($propertyUrls)->concat($landUrls),
        ])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
