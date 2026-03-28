<x-layouts.marketing :title="'Terms of Service - '.config('app.name')">
    <section class="mx-auto max-w-4xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
        <article class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
            <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Terms of Service</h1>
            <p class="mt-3 text-sm text-slate-500">Last updated: {{ now()->format('F j, Y') }}</p>

            <div class="mt-6 space-y-5 text-sm leading-relaxed text-slate-600">
                <p>These Terms govern your use of LuxeNest Kenya, including property browsing, lead submissions, and listing inquiries in Nairobi and across Kenya.</p>
                <p>You agree to provide accurate contact details when using inquiry forms. Misleading, fraudulent, or abusive submissions may be removed and access may be restricted.</p>
                <p>Property information is provided for discovery purposes. Pricing, availability, and listing details may change without notice and should be verified directly with agents or owners.</p>
                <p>LuxeNest Kenya may update platform features, suspend services for maintenance, or modify these Terms. Continued use after updates constitutes acceptance of revised Terms.</p>
                <p>These Terms are governed by the laws of Kenya. Disputes shall be handled within Kenyan jurisdiction unless otherwise required by law.</p>
            </div>
        </article>
    </section>
</x-layouts.marketing>
