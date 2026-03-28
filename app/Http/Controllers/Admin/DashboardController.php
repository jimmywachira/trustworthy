<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Property;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard metrics.
     */
    public function index(): View
    {
        return view('admin.dashboard', [
            'propertiesCount' => Property::query()->count(),
            'availableCount' => Property::query()->where('status', 'available')->count(),
            'soldCount' => Property::query()->where('status', 'sold')->count(),
            'leadsCount' => Lead::query()->count(),
            'recentLeads' => Lead::query()->with('property')->latest()->take(6)->get(),
            'recentProperties' => Property::query()->latest()->take(6)->get(),
        ]);
    }
}
