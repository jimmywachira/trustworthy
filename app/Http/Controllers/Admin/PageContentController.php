<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\SiteContent;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    /**
     * Show content editor.
     */
    public function edit(): View
    {
        return view('admin.pages.edit', [
            'values' => [
                'home' => [
                    'hero_title' => SiteContent::get('home.hero_title'),
                    'hero_subtitle' => SiteContent::get('home.hero_subtitle'),
                ],
                'about' => [
                    'intro' => SiteContent::get('about.intro'),
                    'body' => SiteContent::get('about.body'),
                ],
            ],
        ]);
    }

    /**
     * Update content entries.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'home.hero_title' => ['nullable', 'string', 'max:255'],
            'home.hero_subtitle' => ['nullable', 'string', 'max:1000'],
            'about.intro' => ['nullable', 'string', 'max:1000'],
            'about.body' => ['nullable', 'string', 'max:5000'],
        ]);

        SiteContent::setMany([
            'home.hero_title' => data_get($validated, 'home.hero_title'),
            'home.hero_subtitle' => data_get($validated, 'home.hero_subtitle'),
            'about.intro' => data_get($validated, 'about.intro'),
            'about.body' => data_get($validated, 'about.body'),
        ]);

        return redirect()->route('admin.pages.edit')->with('status', 'Page content updated.');
    }
}
