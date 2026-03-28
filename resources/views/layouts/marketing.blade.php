<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-ghost-white text-slate-900 antialiased">
        <div class="pointer-events-none fixed inset-x-0 top-0 h-80 bg-linear-to-b from-slate-900/6 to-transparent"></div>

        @include('partials.marketing-nav')

        <main class="relative z-10">
            {{ $slot }}
        </main>

        @include('partials.site-footer')
    </body>
</html>
