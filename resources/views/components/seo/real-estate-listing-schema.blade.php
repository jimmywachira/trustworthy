@props([
    'property',
    'currency' => 'KES',
    'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1400&q=80',
])

@php
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'RealEstateListing',
        'name' => $property->title,
        'description' => \Illuminate\Support\Str::limit(strip_tags((string) $property->description), 220),
        'url' => route('properties.show', $property),
        'image' => [$image],
        'offers' => [
            '@type' => 'Offer',
            'price' => (float) $property->price,
            'priceCurrency' => $currency,
            'availability' => $property->status === 'available'
                ? 'https://schema.org/InStock'
                : 'https://schema.org/SoldOut',
            'url' => route('properties.show', $property),
        ],
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => $property->city,
            'addressRegion' => $property->neighborhood,
            'addressCountry' => 'KE',
        ],
        'numberOfRooms' => (int) $property->beds,
        'floorSize' => [
            '@type' => 'QuantitativeValue',
            'value' => (int) $property->sqft,
            'unitText' => 'sqft',
        ],
    ];
@endphp

<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
