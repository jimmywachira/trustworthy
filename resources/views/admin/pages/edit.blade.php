<x-admin.layout title="Manage Page Content">
    <p class="mb-4 text-sm text-slate-600">Update key marketing content without editing Blade templates.</p>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <form method="POST" action="{{ route('admin.pages.update') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <label class="block space-y-2">
                <span class="text-sm font-medium text-slate-700">Home Hero Title</span>
                <input type="text" name="home[hero_title]" value="{{ old('home.hero_title', data_get($values, 'home.hero_title', '')) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5">
                @error('home.hero_title') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </label>

            <label class="block space-y-2">
                <span class="text-sm font-medium text-slate-700">Home Hero Subtitle</span>
                <textarea name="home[hero_subtitle]" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-2.5">{{ old('home.hero_subtitle', data_get($values, 'home.hero_subtitle', '')) }}</textarea>
                @error('home.hero_subtitle') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </label>

            <label class="block space-y-2">
                <span class="text-sm font-medium text-slate-700">About Intro</span>
                <textarea name="about[intro]" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-2.5">{{ old('about.intro', data_get($values, 'about.intro', '')) }}</textarea>
                @error('about.intro') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </label>

            <label class="block space-y-2">
                <span class="text-sm font-medium text-slate-700">About Body</span>
                <textarea name="about[body]" rows="5" class="w-full rounded-xl border border-slate-200 px-4 py-2.5">{{ old('about.body', data_get($values, 'about.body', '')) }}</textarea>
                @error('about.body') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </label>

            <button type="submit" class="rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-500">Save Changes</button>
        </form>
    </div>
</x-admin.layout>
