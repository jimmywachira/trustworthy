<button
    type="button"
    x-data
    @click="$store.theme.toggle()"
    :aria-pressed="$store.theme.current === 'dark'"
    :aria-label="$store.theme.current === 'dark' ? 'Switch to light mode' : 'Switch to dark mode'"
    class="group relative inline-flex h-11 w-20 items-center rounded-full border border-slate-300/90 bg-white/90 px-1.5 shadow-soft backdrop-blur transition-all duration-300 hover:border-emerald-500/60 hover:shadow-premium focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2 dark:border-slate-700 dark:bg-slate-900"
>
    <span class="sr-only">Toggle theme</span>

    <span class="pointer-events-none absolute inset-y-1.5 left-1.5 right-1.5 rounded-full bg-linear-to-r from-amber-200/80 via-emerald-100/70 to-sky-200/80 transition-opacity duration-500 dark:from-slate-700 dark:via-slate-800 dark:to-slate-900"></span>

    <span
        class="relative z-10 inline-flex h-8 w-8 items-center justify-center rounded-full bg-white text-amber-500 shadow transition-all duration-300 ease-out dark:translate-x-9 dark:bg-slate-950 dark:text-slate-200"
    >
        <svg x-show="$store.theme.current === 'light'" x-transition.opacity.duration.200ms class="h-4.5 w-4.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M12 2.25a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75Zm0 16.5a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-1.5a.75.75 0 0 1 .75-.75Zm9-6.75a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 .75.75Zm-16.5 0a.75.75 0 0 1-.75.75H2.25a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 .75.75Zm12.114 6.864a.75.75 0 0 1 0 1.06l-1.06 1.06a.75.75 0 1 1-1.061-1.06l1.06-1.06a.75.75 0 0 1 1.061 0ZM9.507 9.507a.75.75 0 0 1 0 1.061l-1.06 1.06a.75.75 0 0 1-1.06-1.06l1.06-1.06a.75.75 0 0 1 1.06 0Zm7.107-2.12a.75.75 0 0 1-1.061 0l-1.06-1.06a.75.75 0 1 1 1.06-1.06l1.06 1.06a.75.75 0 0 1 0 1.06ZM9.507 14.493a.75.75 0 0 1-1.06 0l-1.06-1.06a.75.75 0 1 1 1.06-1.061l1.06 1.06a.75.75 0 0 1 0 1.061ZM12 7.5a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9Z" />
        </svg>
        <svg x-show="$store.theme.current === 'dark'" x-transition.opacity.duration.200ms class="h-4.5 w-4.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="display: none;">
            <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.82 8.25 8.25 0 0 0 11.773 10.58.75.75 0 0 1 1.03.82A9.75 9.75 0 1 1 9.528 1.718Z" clip-rule="evenodd" />
        </svg>
    </span>
</button>
