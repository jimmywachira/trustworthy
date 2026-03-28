<x-layouts.marketing :title="'Privacy Policy - '.config('app.name')">
    <section class="mx-auto max-w-4xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
        <article class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
            <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Privacy Policy</h1>
            <p class="mt-3 text-sm text-slate-500">Last updated: {{ now()->format('F j, Y') }}</p>

            <div class="mt-6 space-y-5 text-sm leading-relaxed text-slate-600">
                <p>We collect personal data you provide directly, including name, email, phone number, and listing inquiry details.</p>
                <p>Data is used to route leads, improve user experience, detect abuse, and support property transactions and communications.</p>
                <p>We do not sell personal data. We may share limited information with listing agents, service providers, or regulators when required by law.</p>
                <p>You may request access, correction, or deletion of your personal data by contacting <a href="mailto:privacy@luxenest.co.ke" class="font-medium text-emerald-700 hover:text-emerald-600">privacy@luxenest.co.ke</a>.</p>
                <p>We apply technical and organizational safeguards to protect data, but no system can guarantee absolute security.</p>
            </div>
        </article>
    </section>
</x-layouts.marketing>
