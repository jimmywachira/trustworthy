<x-layouts.marketing :title="'About Us - '.config('app.name')">
    <section class="mx-auto max-w-7xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-white p-8 shadow-premium ring-1 ring-slate-200 sm:p-10 dark:bg-slate-900 dark:ring-slate-800">
            <p class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300">Nairobi Real Estate Platform</p>
            <h1 class="mt-4 text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl dark:text-slate-100">About LuxeNest Kenya</h1>
            <p class="mt-4 max-w-3xl text-slate-600 dark:text-slate-300">{{ $aboutIntro }}</p>
            <p class="mt-4 max-w-3xl text-slate-600 dark:text-slate-300">{{ $aboutBody }}</p>
            <p class="mt-4 max-w-3xl text-slate-600 dark:text-slate-300">We combine local market intelligence, premium presentation, and conversion-focused workflows to help buyers, renters, sellers, and developers close faster across Nairobi.</p>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5 dark:border-slate-800 dark:bg-slate-950">
                    <p class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400"><ion-icon name="map-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>Coverage</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900 dark:text-slate-100">Westlands, Kilimani, Karen, Runda, Kileleshwa</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5 dark:border-slate-800 dark:bg-slate-950">
                    <p class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400"><ion-icon name="flash-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>Response SLA</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900 dark:text-slate-100">Lead callback in under 30 minutes (business hours)</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5 dark:border-slate-800 dark:bg-slate-950">
                    <p class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400"><ion-icon name="time-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>Support Hours</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900 dark:text-slate-100">Mon - Sat, 8:00 AM - 6:00 PM EAT</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5 dark:border-slate-800 dark:bg-slate-950">
                    <p class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400"><ion-icon name="shield-checkmark-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>Compliance</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900 dark:text-slate-100">Kenya Data Protection Act aligned process</p>
                </article>
            </div>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-3">
            <article class="rounded-3xl bg-white p-6 shadow-premium ring-1 ring-slate-200 lg:col-span-2 dark:bg-slate-900 dark:ring-slate-800">
                <h2 class="inline-flex items-center gap-2 text-xl font-semibold tracking-tight text-slate-900 dark:text-slate-100"><ion-icon name="call-outline" class="h-5 w-5 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>Contact Details</h2>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Reach our team directly for property inquiries, seller onboarding, partnership conversations, and media requests.</p>

                @if (session('status'))
                    <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-500/30 dark:bg-emerald-500/15 dark:text-emerald-200">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <p class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400"><ion-icon name="mail-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>General Inquiries</p>
                        <p class="mt-2 text-sm text-slate-700 dark:text-slate-300"><a href="mailto:hello@luxenest.co.ke" class="font-semibold text-emerald-700 hover:text-emerald-600 dark:text-emerald-300 dark:hover:text-emerald-200">hello@luxenest.co.ke</a></p>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">For buying, renting, and platform support.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <p class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400"><ion-icon name="headset-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Sales Desk</p>
                        <p class="mt-2 text-sm text-slate-700 dark:text-slate-300"><a href="tel:+254700123456" class="font-semibold text-emerald-700 hover:text-emerald-600 dark:text-emerald-300 dark:hover:text-emerald-200">+254 700 123 456</a></p>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">For premium listings, valuation consults, and seller onboarding.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <p class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400"><ion-icon name="people-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Partnerships</p>
                        <p class="mt-2 text-sm text-slate-700 dark:text-slate-300"><a href="mailto:partners@luxenest.co.ke" class="font-semibold text-emerald-700 hover:text-emerald-600 dark:text-emerald-300 dark:hover:text-emerald-200">partners@luxenest.co.ke</a></p>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">For developers, agencies, and channel partnerships.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <p class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400"><ion-icon name="business-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Office</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700 dark:text-slate-200">Westlands, Nairobi, Kenya</p>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">By appointment for client strategy and property consultations.</p>
                    </div>
                </div>

                <div class="mt-6 rounded-2xl border border-slate-200 p-5 dark:border-slate-800 dark:bg-slate-950">
                    <h3 class="inline-flex items-center gap-2 text-base font-semibold text-slate-900 dark:text-slate-100"><ion-icon name="paper-plane-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>Contact Us</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Send us your inquiry and our team will follow up promptly.</p>

                    <form method="POST" action="{{ route('about.contact.store') }}" class="mt-4 space-y-4">
                        @csrf

                        <div class="grid gap-4 sm:grid-cols-2">
                            <label class="block space-y-2">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Name</span>
                                <input name="name" value="{{ old('name') }}" type="text" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100" placeholder="Jane Doe" required>
                                @error('name') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                            </label>

                            <label class="block space-y-2">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Email</span>
                                <input name="email" value="{{ old('email') }}" type="email" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100" placeholder="you@example.com" required>
                                @error('email') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                            </label>
                        </div>

                        <label class="block space-y-2">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Phone</span>
                            <input name="phone" value="{{ old('phone') }}" type="text" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100" placeholder="+254 700 123 456">
                            @error('phone') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </label>

                        <label class="block space-y-2">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Message</span>
                            <textarea name="message" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100" placeholder="Tell us what you need help with..." required>{{ old('message') }}</textarea>
                            @error('message') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </label>

                        <button type="submit" class="inline-flex rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-500 dark:bg-emerald-500 dark:hover:bg-emerald-400">
                            Submit Inquiry
                        </button>
                    </form>
                </div>
            </article>

            <aside class="rounded-3xl bg-slate-900 p-6 text-slate-100 shadow-premium ring-1 ring-slate-800 dark:bg-slate-900">
                <h2 class="text-lg font-semibold tracking-tight text-white">Why Clients Choose Us</h2>
                <ul class="mt-4 space-y-3 text-sm text-slate-200">
                    <li class="inline-flex items-start gap-2"><ion-icon name="checkmark-circle-outline" class="mt-0.5 h-4 w-4 text-emerald-300" aria-hidden="true"></ion-icon><span>Accurate neighborhood-level discovery with high-intent filtering.</span></li>
                    <li class="inline-flex items-start gap-2"><ion-icon name="checkmark-circle-outline" class="mt-0.5 h-4 w-4 text-emerald-300" aria-hidden="true"></ion-icon><span>Premium listing presentation designed for serious buyers and tenants.</span></li>
                    <li class="inline-flex items-start gap-2"><ion-icon name="checkmark-circle-outline" class="mt-0.5 h-4 w-4 text-emerald-300" aria-hidden="true"></ion-icon><span>Structured lead handling with quick response workflows.</span></li>
                    <li class="inline-flex items-start gap-2"><ion-icon name="checkmark-circle-outline" class="mt-0.5 h-4 w-4 text-emerald-300" aria-hidden="true"></ion-icon><span>Verified agent network with transparent communication standards.</span></li>
                </ul>

                <div class="mt-6 rounded-2xl bg-white/10 p-4 ring-1 ring-white/10">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-300">Need Immediate Support?</p>
                    <p class="mt-2 text-sm text-white">Call our desk for urgent viewing requests and same-day shortlist support.</p>
                    <a href="tel:+254700123456" class="mt-3 inline-flex items-center gap-2 rounded-xl bg-emerald-500 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-400"><ion-icon name="call-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Call Now</a>
                </div>
            </aside>
        </div>

        <div class="mt-8 rounded-3xl bg-white p-6 shadow-premium ring-1 ring-slate-200 sm:p-8 dark:bg-slate-900 dark:ring-slate-800">
            <div class="mb-5">
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Frequently Asked Questions</h2>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Answers to common questions from buyers, renters, sellers, and investment clients.</p>
            </div>

            <div class="space-y-3">
                <details class="group rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950" open>
                    <summary class="cursor-pointer list-none pr-6 text-sm font-semibold text-slate-900 dark:text-slate-100"><span class="inline-flex items-center gap-2"><ion-icon name="help-circle-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>How quickly can I schedule a property viewing?</span></summary>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Most viewing requests are acknowledged within 30 minutes during business hours. Confirmed appointments are typically available the same day or next day depending on property access.</p>
                </details>

                <details class="group rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950">
                    <summary class="cursor-pointer list-none pr-6 text-sm font-semibold text-slate-900 dark:text-slate-100"><span class="inline-flex items-center gap-2"><ion-icon name="help-circle-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>Do you only handle luxury properties?</span></summary>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Our focus is premium and high-trust listings, but we support a wide range of professional residential and investment opportunities across Nairobi neighborhoods.</p>
                </details>

                <details class="group rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950">
                    <summary class="cursor-pointer list-none pr-6 text-sm font-semibold text-slate-900 dark:text-slate-100"><span class="inline-flex items-center gap-2"><ion-icon name="help-circle-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>How do I list my property on LuxeNest Kenya?</span></summary>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Contact our sales desk or email us with your property details. Our team will review fit, verify documentation, and guide you through onboarding and media requirements.</p>
                </details>

                <details class="group rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950">
                    <summary class="cursor-pointer list-none pr-6 text-sm font-semibold text-slate-900 dark:text-slate-100"><span class="inline-flex items-center gap-2"><ion-icon name="help-circle-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>Are my personal details secure?</span></summary>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Yes. We operate privacy workflows aligned to Kenya's Data Protection Act. You can review our legal pages for terms, privacy, and cookie controls.</p>
                </details>

                <details class="group rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950">
                    <summary class="cursor-pointer list-none pr-6 text-sm font-semibold text-slate-900 dark:text-slate-100"><span class="inline-flex items-center gap-2"><ion-icon name="help-circle-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>Can developers or agencies partner with LuxeNest?</span></summary>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Yes. We support qualified partners for listing distribution, project launches, and lead-routing integrations. Reach out through our partnerships email for a tailored onboarding call.</p>
                </details>
            </div>
        </div>
    </section>
</x-layouts.marketing>
