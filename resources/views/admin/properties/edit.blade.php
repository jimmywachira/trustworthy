<x-admin.layout title="Edit Property">
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        @include('admin.properties.form', [
            'action' => route('admin.properties.update', $property),
            'method' => 'PUT',
            'property' => $property,
            'amenitiesText' => $amenitiesText,
        ])
    </div>
</x-admin.layout>
