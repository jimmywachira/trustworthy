<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactLeadController extends Controller
{
    /**
     * Capture a general contact inquiry and store it in leads pipeline.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $fallbackPropertyId = Property::query()->value('id');

        if (! $fallbackPropertyId) {
            return redirect()
                ->route('about')
                ->withErrors(['message' => 'Inquiry could not be captured right now. Please call +254 700 123 456 for immediate support.'])
                ->withInput();
        }

        Lead::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'],
            'property_id' => $fallbackPropertyId,
        ]);

        return redirect()->route('about')->with('status', 'Thanks for contacting LuxeNest. Our team will reach out shortly.');
    }
}
