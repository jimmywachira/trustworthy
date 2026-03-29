@props([
    'seo' => [],
    'title' => null,
])

@php
    $seo = is_array($seo) ? $seo : [];
    $resolvedTitle = (string) ($seo['title'] ?? $title ?? config('app.name'));
    $resolvedDescription = (string) ($seo['description'] ?? 'Premium real estate platform for Nairobi listings, rentals, and investment opportunities.');
    $resolvedCanonical = (string) ($seo['canonical'] ?? url()->current());
    $resolvedRobots = (string) ($seo['robots'] ?? 'index,follow');

    $og = array_merge([
        'title' => $resolvedTitle,
        'description' => $resolvedDescription,
        'type' => 'website',
        'url' => $resolvedCanonical,
        'image' => null,
        'site_name' => config('app.name'),
    ], is_array($seo['og'] ?? null) ? $seo['og'] : []);

    $twitter = array_merge([
        'card' => 'summary_large_image',
        'title' => $resolvedTitle,
        'description' => $resolvedDescription,
        'image' => $og['image'],
    ], is_array($seo['twitter'] ?? null) ? $seo['twitter'] : []);
@endphp

<meta name="description" content="{{ $resolvedDescription }}">
<meta name="robots" content="{{ $resolvedRobots }}">
<link rel="canonical" href="{{ $resolvedCanonical }}">

<meta property="og:title" content="{{ $og['title'] }}">
<meta property="og:description" content="{{ $og['description'] }}">
<meta property="og:type" content="{{ $og['type'] }}">
<meta property="og:url" content="{{ $og['url'] }}">
@if ($og['image'])
    <meta property="og:image" content="{{ $og['image'] }}">
@endif
@if (! empty($og['site_name']))
    <meta property="og:site_name" content="{{ $og['site_name'] }}">
@endif

<meta name="twitter:card" content="{{ $twitter['card'] }}">
<meta name="twitter:title" content="{{ $twitter['title'] }}">
<meta name="twitter:description" content="{{ $twitter['description'] }}">
@if (! empty($twitter['image']))
    <meta name="twitter:image" content="{{ $twitter['image'] }}">
@endif
