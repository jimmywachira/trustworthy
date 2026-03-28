<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LeadController extends Controller
{
    /**
     * Display paginated leads.
     */
    public function index(): View
    {
        return view('admin.leads.index', [
            'leads' => Lead::query()->with('property')->latest()->paginate(20),
        ]);
    }

    /**
     * Remove a lead record.
     */
    public function destroy(Lead $lead): RedirectResponse
    {
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('status', 'Lead removed.');
    }
}
