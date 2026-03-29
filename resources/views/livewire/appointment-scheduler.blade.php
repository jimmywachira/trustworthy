<div x-data="{ open: false }" class="w-full">
    <button
        type="button"
        @click="open = true"
        class="w-full rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
    >
        Schedule Visit
    </button>

    <div
        x-show="open"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/70 px-4"
        @keydown.escape.window="open = false"
    >
        <div class="absolute inset-0" @click="open = false"></div>

        <div class="relative z-10 w-full max-w-xl rounded-2xl bg-white p-6 shadow-sm">
            <div class="mb-5 flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-slate-900">Book an Appointment</h3>
                    <p class="text-sm text-slate-500">Choose a date and time that works for you.</p>
                </div>
                <button @click="open = false" class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700" type="button">
                    <span class="sr-only">Close</span>
                    <ion-icon name="close-outline" class="h-5 w-5" aria-hidden="true"></ion-icon>
                </button>
            </div>

            <form wire:submit="schedule" class="space-y-4">
                <div class="grid gap-4 md:grid-cols-2">
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
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <label class="block space-y-2">
                        <span class="text-sm font-medium text-slate-700">Phone</span>
                        <input wire:model="phone" type="text" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20" placeholder="+254 700 123 456">
                        @error('phone') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                    </label>

                    <label class="block space-y-2">
                        <span class="text-sm font-medium text-slate-700">Preferred Date & Time</span>
                        <input wire:model="preferredAt" type="datetime-local" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20">
                        @error('preferredAt') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                    </label>
                </div>

                <label class="block space-y-2">
                    <span class="text-sm font-medium text-slate-700">Message (optional)</span>
                    <textarea wire:model="message" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20" placeholder="Tell us your preferred viewing details..."></textarea>
                    @error('message') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </label>

                <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-500">
                    Confirm Appointment Request
                </button>
            </form>

            <p x-on:appointment-scheduled.window="open = false" class="mt-4 text-xs text-slate-500">
                We will confirm your appointment by email or phone.
            </p>
        </div>
    </div>
</div>
