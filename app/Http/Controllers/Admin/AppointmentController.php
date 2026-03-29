<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display paginated appointments.
     */
    public function index(): View
    {
        return view('admin.appointments.index', [
            'appointments' => Appointment::query()
                ->with(['property', 'agent', 'user'])
                ->orderByDesc('preferred_at')
                ->paginate(20),
        ]);
    }

    /**
     * Update appointment status.
     */
    public function updateStatus(Request $request, Appointment $appointment): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,confirmed,cancelled'],
        ]);

        $appointment->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.appointments.index')
            ->with('status', 'Appointment status updated.');
    }
}
