@php
    $dark = $dark ?? false;
@endphp

<footer class="border-t backdrop-blur-md lg:backdrop-blur-lg {{ $dark ? 'border-slate-700/85 bg-slate-900/92 text-slate-200 lg:bg-slate-900/88' : 'border-slate-200/85 bg-white/90 text-slate-700 lg:bg-white/82 dark:border-slate-800/85 dark:bg-slate-950/90 dark:text-slate-300 dark:lg:bg-slate-950/84' }}">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid-cols-4 lg:px-8">
        <div>
            <h3 class="text-lg font-semibold {{ $dark ? 'text-white' : 'text-slate-900 dark:text-slate-100' }}">LuxeNest Kenya</h3>
            <p class="mt-3 leading-relaxed {{ $dark ? 'text-slate-300' : 'text-slate-600 dark:text-slate-400' }}">
                Premium property discovery and lead generation platform built for Nairobi's fast-moving real estate market.
            </p>
        </div>

        <div>
            <h4 class="font-semibold capitalize tracking-wide {{ $dark ? 'text-slate-100' : 'text-slate-900 dark:text-slate-100' }}">Quick Links</h4>
            <ul class="mt-3 space-y-2 ">
                <li><a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 transition hover:text-emerald-500"><ion-icon name="home-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Home</a></li>
                <li><a href="{{ route('properties.index', ['type' => 'sale']) }}" class="inline-flex items-center gap-1.5 transition hover:text-emerald-500"><ion-icon name="trending-up-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Buy</a></li>
                <li><a href="{{ route('properties.index', ['type' => 'rent']) }}" class="inline-flex items-center gap-1.5 transition hover:text-emerald-500"><ion-icon name="key-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Rent</a></li>
                <li><a href="{{ route('sell') }}" class="inline-flex items-center gap-1.5 transition hover:text-emerald-500"><ion-icon name="pricetags-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Sell</a></li>
                <li><a href="{{ route('about') }}" class="inline-flex items-center gap-1.5 transition hover:text-emerald-500"><ion-icon name="planet-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>About Us</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-semibold capitalize tracking-wide {{ $dark ? 'text-slate-100' : 'text-slate-900 dark:text-slate-100' }}">Contact Nairobi HQ</h4>
            <ul class="mt-3 space-y-2 {{ $dark ? 'text-slate-300' : 'text-slate-600 dark:text-slate-400' }}">
                <li class="inline-flex items-center gap-1.5"><ion-icon name="location-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Westlands, Nairobi, Kenya</li>
                <li><a href="tel:+254700123456" class="inline-flex items-center gap-1.5 transition hover:text-emerald-500"><ion-icon name="call-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>+254 700 123 456</a></li>
                <li><a href="mailto:hello@luxenest.co.ke" class="inline-flex items-center gap-1.5 transition hover:text-emerald-500"><ion-icon name="mail-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>hello@luxenest.co.ke</a></li>
                <li>Mon - Sat, 8:00 AM - 6:00 PM EAT</li>
            </ul>
        </div>

        <div>
            <h4 class="font-semibold capitalize tracking-wide {{ $dark ? 'text-slate-100' : 'text-slate-900 dark:text-slate-100' }}">Legal</h4>
            <ul class="mt-3 space-y-2 {{ $dark ? 'text-slate-300' : 'text-slate-600 dark:text-slate-400' }}">
                <li><a href="{{ route('legal.terms') }}" class="inline-flex items-center gap-1.5 transition hover:text-emerald-500"><ion-icon name="document-text-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Terms of Service</a></li>
                <li><a href="{{ route('legal.privacy') }}" class="inline-flex items-center gap-1.5 transition hover:text-emerald-500"><ion-icon name="shield-checkmark-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Privacy Policy</a></li>
                <li><a href="{{ route('legal.cookies') }}" class="inline-flex items-center gap-1.5 transition hover:text-emerald-500"><ion-icon name="settings-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Cookie Preferences</a></li>
                <li><a href="{{ route('legal.data-protection') }}" class="inline-flex items-center gap-1.5 transition hover:text-emerald-500"><ion-icon name="ribbon-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Data Protection Act (Kenya) Compliant</a></li>
            </ul>
        </div>
    </div>

    <div class="border-t {{ $dark ? 'border-slate-700/80 text-slate-400' : 'border-slate-200 text-slate-500 dark:border-slate-800 dark:text-slate-400' }}">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-4 text-xs sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
            <p>© {{ now()->year }} LuxeNest Kenya. All rights reserved.</p>
            <p>Made for Nairobi real estate professionals.</p>
        </div>
    </div>
</footer>