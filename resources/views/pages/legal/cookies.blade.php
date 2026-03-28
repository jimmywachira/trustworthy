<x-layouts.marketing :title="'Cookie Preferences - '.config('app.name')">
    <section class="mx-auto max-w-4xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
        <article class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
            <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Cookie Preferences</h1>
            <p class="mt-3 text-sm text-slate-500">Last updated: {{ now()->format('F j, Y') }}</p>

            <div class="mt-6 space-y-5 text-sm leading-relaxed text-slate-600">
                <p>Cookies help us keep sessions active, remember preferences, and measure feature usage for continuous improvements.</p>
                <p><strong>Essential cookies</strong> are required for security, authentication, and core platform functionality.</p>
                <p><strong>Analytics cookies</strong> help us understand page performance and user interactions in aggregate form.</p>
                <p>You can manage cookies in your browser settings. Disabling essential cookies may impact login and inquiry flows.</p>
                <p>For cookie questions, contact <a href="mailto:privacy@luxenest.co.ke" class="font-medium text-emerald-700 hover:text-emerald-600">privacy@luxenest.co.ke</a>.</p>
            </div>
        </article>
    </section>
</x-layouts.marketing>
