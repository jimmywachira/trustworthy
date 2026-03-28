<x-admin.layout title="Manage Properties">
    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-slate-600">Create, edit, and remove property listings.</p>
        <a href="{{ route('admin.properties.create') }}" class="rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-500">Add Property</a>
    </div>

    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Location</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($properties as $property)
                        <tr class="border-t border-slate-100">
                            <td class="px-4 py-3 font-medium text-slate-900">{{ $property->title }}</td>
                            <td class="px-4 py-3 uppercase text-slate-600">{{ $property->type }}</td>
                            <td class="px-4 py-3 uppercase text-slate-600">{{ $property->status }}</td>
                            <td class="px-4 py-3"><x-price :amount="$property->price" /></td>
                            <td class="px-4 py-3 text-slate-600">{{ $property->city }}, {{ $property->neighborhood }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.properties.edit', $property) }}" class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50">Edit</a>
                                    <form method="POST" action="{{ route('admin.properties.destroy', $property) }}" onsubmit="return confirm('Delete this property?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-50">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-100 px-4 py-3">
            {{ $properties->links() }}
        </div>
    </div>
</x-admin.layout>
