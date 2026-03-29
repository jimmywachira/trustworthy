<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

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

<title>
    {{ $seo['title'] ?? (filled($title ?? null) ? $title.' - '.config('app.name', 'Laravel') : config('app.name', 'Laravel')) }}
</title>

<x-seo.meta :seo="$seo ?? []" :title="$title ?? null" />

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
