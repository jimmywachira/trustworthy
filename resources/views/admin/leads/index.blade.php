<x-admin.layout title="Manage Leads">
    <p class="mb-4 text-sm text-slate-600">Track user inquiries and clean up spam or duplicate leads.</p>

    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Message</th>
                        <th class="px-4 py-3">Property</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($leads as $lead)
                        <tr class="border-t border-slate-100">
                            <td class="px-4 py-3 font-medium text-slate-900">{{ $lead->name }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $lead->email }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $lead->phone ?: 'N/A' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $lead->message ?: 'No message provided.' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $lead->property?->title ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $lead->created_at->format('M j, Y H:i') }}</td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('admin.leads.destroy', $lead) }}" onsubmit="return confirm('Delete this lead?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-50">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-slate-500">No leads captured yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-100 px-4 py-3">
            {{ $leads->links() }}
        </div>
    </div>
</x-admin.layout>
