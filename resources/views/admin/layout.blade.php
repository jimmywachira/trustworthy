<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Admin' }} - {{ config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
        <div class="flex min-h-screen">
            <aside class="hidden w-72 flex-col border-r font-semibold border-slate-200 bg-white p-5 lg:flex">
                <a href="{{ route('admin.dashboard') }}" class="mb-8 text-lg font-semibold tracking-tight text-slate-900">LuxeNest Admin</a>

                <nav class="space-y-1 text-sm">
                    <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100' }}">Dashboard</a>
                    <a href="{{ route('admin.properties.index') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('admin.properties.*') ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100' }}">Properties</a>
                    <a href="{{ route('admin.leads.index') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('admin.leads.*') ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100' }}">Leads</a>
                    <a href="{{ route('admin.pages.edit') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('admin.pages.*') ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100' }}">Page Content</a>
                </nav>

                <div class="mt-auto space-y-3">
                    <a href="{{ route('home') }}" class="block rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">View Site</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full rounded-lg bg-emerald-600 px-3 py-2 text-sm font-semibold text-white hover:bg-emerald-500">Sign Out</button>
                    </form>
                </div>
            </aside>

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <header class="mb-6 flex items-center justify-between rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                    <h1 class="text-xl font-semibold tracking-tight text-slate-900">{{ $title ?? 'Admin' }}</h1>
                    <p class="text-xs text-slate-500">Nairobi, Kenya</p>
                </header>

                @if (session('status'))
                    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </body>
</html>
