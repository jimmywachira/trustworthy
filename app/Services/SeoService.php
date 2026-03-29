<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Support\Str;

class SeoService
{
    /**
     * Build generic SEO payload for regular pages.
     *
     * @return array<string, mixed>
     */
    public static function forPage(string $title, string $description, ?string $canonical = null): array
    {
        $siteName = config('app.name');
        $fullTitle = $title.' | '.$siteName;
        $summary = Str::limit(trim(strip_tags($description)), 160);

        return [
            'title' => $fullTitle,
            'description' => $summary,
            'canonical' => $canonical ?? url()->current(),
            'robots' => 'index,follow',
            'og' => [
                'title' => $fullTitle,
                'description' => $summary,
                'type' => 'website',
                'url' => $canonical ?? url()->current(),
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1400&q=80',
                'site_name' => $siteName,
            ],
            'twitter' => [
                'card' => 'summary_large_image',
                'title' => $fullTitle,
                'description' => $summary,
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1400&q=80',
            ],
        ];
    }

    /**
     * Build property-specific SEO payload.
     *
     * @return array<string, mixed>
     */
    public static function forProperty(Property $property): array
    {
        $location = collect([$property->neighborhood, $property->city])
            ->filter()
            ->implode(', ');

        $title = trim($property->title.' - '.$location);
        $description = Str::limit(trim(strip_tags($property->description)), 160);
        $canonical = route('properties.show', $property);
        $image = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1400&q=80';

        $seo = self::forPage($title, $description, $canonical);
        $seo['og']['type'] = 'product';
        $seo['og']['image'] = $image;
        $seo['twitter']['image'] = $image;

        return $seo;
    }
}
