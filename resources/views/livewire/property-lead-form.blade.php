<div x-data="{ open: false }" class="w-full">
    <button
        type="button"
        @click="open = true"
        class="w-full rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500"
    >
        Inquire About This Property
    </button>

    <div
        x-show="open"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/70 px-4"
        @keydown.escape.window="open = false"
    >
        <div class="absolute inset-0" @click="open = false"></div>

        <div class="relative z-10 w-full max-w-lg rounded-2xl bg-white p-6 shadow-sm">
            <div class="mb-5 flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-slate-900">Request a Callback</h3>
                    <p class="text-sm text-slate-500">{{ $property->title }}</p>
                </div>
                <button @click="open = false" class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700" type="button">
                    <span class="sr-only">Close</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form wire:submit="submit" class="space-y-4">
                <label class="block space-y-2">
                    <span class="text-sm font-medium text-slate-700">Name</span>
                    <input wire:model="name" type="text" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20" placeholder="Jane Doe">
                    @error('name') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </label>

                <label class="block space-y-2">
                    <span class="text-sm font-medium text-slate-700">Email</span>
                    <input wire:model="email" type="email" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20" placeholder="you@example.com">
                    @error('email') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </label>

                <label class="block space-y-2">
                    <span class="text-sm font-medium text-slate-700">Phone (optional)</span>
                    <input wire:model="phone" type="text" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20" placeholder="+1 555 123 4567">
                    @error('phone') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </label>

                <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-500">
                    Send Inquiry
                </button>
            </form>

            <p x-on:lead-submitted.window="open = false" class="mt-4 text-xs text-slate-500">
                Response time is usually under 10 minutes during business hours.
            </p>
        </div>
    </div>
</div>
