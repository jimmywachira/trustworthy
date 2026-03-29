<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Property;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InvestorPackController extends Controller
{
    /**
     * Render a print-friendly investment brief page for PDF export.
     */
    public function brief(): View
    {
        $saleQuery = Property::query()->where('status', 'available')->where('type', 'sale');

        $summary = [
            'saleCount' => (clone $saleQuery)->count(),
            'avgSalePrice' => (float) ((clone $saleQuery)->avg('price') ?? 0),
            'landCount' => (clone $saleQuery)
                ->where(function ($query): void {
                    $query->where('title', 'like', '%land%')
                        ->orWhere('title', 'like', '%plot%')
                        ->orWhere('description', 'like', '%land%')
                        ->orWhere('description', 'like', '%acre%');
                })
                ->count(),
            'commercialCount' => (clone $saleQuery)
                ->where(function ($query): void {
                    $query->where('title', 'like', '%commercial%')
                        ->orWhere('title', 'like', '%office%')
                        ->orWhere('title', 'like', '%retail%')
                        ->orWhere('description', 'like', '%commercial%')
                        ->orWhere('description', 'like', '%yield%');
                })
                ->count(),
        ];

        $primeNeighborhoods = (clone $saleQuery)
            ->selectRaw('neighborhood, COUNT(*) as listings_count, AVG(price) as avg_price')
            ->whereNotNull('neighborhood')
            ->groupBy('neighborhood')
            ->orderByDesc('listings_count')
            ->take(8)
            ->get();

        return view('pages.investor-pack-brief', [
            'summary' => $summary,
            'primeNeighborhoods' => $primeNeighborhoods,
            'generatedAt' => now(),
        ]);
    }

    /**
     * Capture investor pack request in existing leads pipeline.
     */
    public function requestPack(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'country' => ['nullable', 'string', 'max:120'],
            'budget_range' => ['nullable', 'string', 'max:120'],
            'asset_focus' => ['nullable', 'string', 'max:120'],
        ]);

        $fallbackPropertyId = Property::query()
            ->where('type', 'sale')
            ->where('status', 'available')
            ->value('id') ?? Property::query()->value('id');

        if (! $fallbackPropertyId) {
            return redirect()
                ->route('buy')
                ->withErrors(['investor_pack' => 'Investor pack request could not be captured right now. Please call +254 700 123 456 for immediate support.'])
                ->withInput();
        }

        $messageParts = [
            'Investor Download Pack Request',
            'Country: '.($validated['country'] ?? 'Not specified'),
            'Budget Range: '.($validated['budget_range'] ?? 'Not specified'),
            'Asset Focus: '.($validated['asset_focus'] ?? 'Not specified'),
        ];

        Lead::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => implode("\n", $messageParts),
            'property_id' => $fallbackPropertyId,
        ]);

        return redirect()
            ->route('buy')
            ->with('investor_pack_status', 'Investor Pack requested successfully. Our advisory team will contact you shortly.');
    }
}
