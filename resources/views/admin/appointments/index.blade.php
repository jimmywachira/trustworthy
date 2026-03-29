<x-admin.layout title="Manage Appointments">
    <p class="mb-4 text-sm text-slate-600">Review viewing requests and update booking status for agents and clients.</p>

    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3">Client</th>
                        <th class="px-4 py-3">Property</th>
                        <th class="px-4 py-3">Agent</th>
                        <th class="px-4 py-3">Preferred Time</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Message</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($appointments as $appointment)
                        <tr class="border-t border-slate-100 align-top">
                            <td class="px-4 py-3">
                                <p class="font-medium text-slate-900">{{ $appointment->name }}</p>
                                <p class="text-slate-600">{{ $appointment->email }}</p>
                                <p class="text-slate-500">{{ $appointment->phone ?: 'N/A' }}</p>
                            </td>
                            <td class="px-4 py-3 text-slate-600">
                                {{ $appointment->property?->title ?? 'N/A' }}
                            </td>
                            <td class="px-4 py-3 text-slate-600">
                                {{ $appointment->agent?->name ?? 'Unassigned' }}
                            </td>
                            <td class="px-4 py-3 text-slate-600">
                                {{ $appointment->preferred_at?->timezone(config('app.timezone'))->format('M j, Y H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                @php
                                    $statusClasses = match ($appointment->status) {
                                        'confirmed' => 'bg-emerald-100 text-emerald-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                        default => 'bg-amber-100 text-amber-700',
                                    };
                                @endphp
                                <span class="rounded-full px-2.5 py-1 text-xs font-semibold uppercase tracking-wide {{ $statusClasses }}">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-slate-600">
                                {{ $appointment->message ?: 'No additional notes.' }}
                            </td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('admin.appointments.update-status', $appointment) }}" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="rounded-lg border border-slate-200 px-2 py-1.5 text-xs">
                                        <option value="pending" @selected($appointment->status === 'pending')>Pending</option>
                                        <option value="confirmed" @selected($appointment->status === 'confirmed')>Confirmed</option>
                                        <option value="cancelled" @selected($appointment->status === 'cancelled')>Cancelled</option>
                                    </select>
                                    <button type="submit" class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50">Update</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-slate-500">No appointments booked yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-100 px-4 py-3">
            {{ $appointments->links() }}
        </div>
    </div>
</x-admin.layout>
