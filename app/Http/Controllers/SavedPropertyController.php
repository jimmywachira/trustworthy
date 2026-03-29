<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SavedPropertyController extends Controller
{
    /**
     * Show the authenticated user's saved properties.
     */
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $savedProperties = $user
            ->savedProperties()
            ->latest('saved_properties.created_at')
            ->paginate(12);

        return view('pages.saved-properties', [
            'savedProperties' => $savedProperties,
        ]);
    }

    /**
     * Toggle saved state for a property.
     */
    public function toggle(Property $property): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $alreadySaved = $user->savedProperties()->where('property_id', $property->id)->exists();

        if ($alreadySaved) {
            $user->savedProperties()->detach($property->id);

            return back()->with('status', 'Property removed from saved list.');
        }

        $user->savedProperties()->attach($property->id);

        return back()->with('status', 'Property saved successfully.');
    }
}
