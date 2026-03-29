<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script>
            (function () {
                const storageKey = 'trustworthy-theme';

                try {
                    const stored = localStorage.getItem(storageKey);
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    const isDark = stored ? stored === 'dark' : prefersDark;

                    document.documentElement.classList.toggle('dark', isDark);
                    document.documentElement.setAttribute('data-theme', isDark ? 'dark' : 'light');
                } catch {
                    document.documentElement.classList.toggle('dark', window.matchMedia('(prefers-color-scheme: dark)').matches);
                }
            })();
        </script>

        <title>{{ $title ?? config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="relative isolate min-h-screen bg-slate-50 text-slate-800 antialiased transition-colors dark:bg-slate-950 dark:text-slate-200">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10 h-full w-full bg-[linear-gradient(to_right,rgba(148,163,184,0.18)_1px,transparent_1px),linear-gradient(to_bottom,rgba(148,163,184,0.18)_1px,transparent_1px)] bg-size-[6rem_4rem] dark:bg-[linear-gradient(to_right,rgba(51,65,85,0.35)_1px,transparent_1px),linear-gradient(to_bottom,rgba(51,65,85,0.35)_1px,transparent_1px)]"></div>
        <div aria-hidden="true" class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-80 bg-linear-to-b from-slate-900/6 to-transparent dark:from-emerald-500/10"></div>

        @include('partials.marketing-nav')

        <main class="relative z-10">
            {{ $slot }}
        </main>

        @include('partials.site-footer')
    </body>
</html>
