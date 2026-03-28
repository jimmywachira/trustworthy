@php
    $dark = $dark ?? false;
@endphp

<footer class="border-t {{ $dark ? 'border-slate-700/80 bg-slate-900 text-slate-200' : 'border-slate-200 bg-white text-slate-700' }}">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid-cols-4 lg:px-8">
        <div>
            <h3 class="text-lg font-semibold {{ $dark ? 'text-white' : 'text-slate-900' }}">LuxeNest Kenya</h3>
            <p class="mt-3 text-sm leading-relaxed {{ $dark ? 'text-slate-300' : 'text-slate-600' }}">
                Premium property discovery and lead generation platform built for Nairobi's fast-moving real estate market.
            </p>
        </div>

        <div>
            <h4 class="text-sm font-semibold uppercase tracking-wide {{ $dark ? 'text-slate-100' : 'text-slate-900' }}">Quick Links</h4>
            <ul class="mt-3 space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="transition hover:text-emerald-500">Home</a></li>
                <li><a href="{{ route('properties.index', ['type' => 'sale']) }}" class="transition hover:text-emerald-500">Buy</a></li>
                <li><a href="{{ route('properties.index', ['type' => 'rent']) }}" class="transition hover:text-emerald-500">Rent</a></li>
                <li><a href="{{ route('sell') }}" class="transition hover:text-emerald-500">Sell</a></li>
                <li><a href="{{ route('about') }}" class="transition hover:text-emerald-500">About Us</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-semibold uppercase tracking-wide {{ $dark ? 'text-slate-100' : 'text-slate-900' }}">Contact Nairobi HQ</h4>
            <ul class="mt-3 space-y-2 text-sm {{ $dark ? 'text-slate-300' : 'text-slate-600' }}">
                <li>Westlands, Nairobi, Kenya</li>
                <li><a href="tel:+254700123456" class="transition hover:text-emerald-500">+254 700 123 456</a></li>
                <li><a href="mailto:hello@luxenest.co.ke" class="transition hover:text-emerald-500">hello@luxenest.co.ke</a></li>
                <li>Mon - Sat, 8:00 AM - 6:00 PM EAT</li>
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-semibold uppercase tracking-wide {{ $dark ? 'text-slate-100' : 'text-slate-900' }}">Legal</h4>
            <ul class="mt-3 space-y-2 text-sm {{ $dark ? 'text-slate-300' : 'text-slate-600' }}">
                <li><a href="{{ route('legal.terms') }}" class="transition hover:text-emerald-500">Terms of Service</a></li>
                <li><a href="{{ route('legal.privacy') }}" class="transition hover:text-emerald-500">Privacy Policy</a></li>
                <li><a href="{{ route('legal.cookies') }}" class="transition hover:text-emerald-500">Cookie Preferences</a></li>
                <li><a href="{{ route('legal.data-protection') }}" class="transition hover:text-emerald-500">Data Protection Act (Kenya) Compliant</a></li>
            </ul>
        </div>
    </div>

    <div class="border-t {{ $dark ? 'border-slate-700/80 text-slate-400' : 'border-slate-200 text-slate-500' }}">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-4 text-xs sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
            <p>© {{ now()->year }} LuxeNest Kenya. All rights reserved.</p>
            <p>Made for Nairobi real estate professionals.</p>
        </div>
    </div>
</footer>