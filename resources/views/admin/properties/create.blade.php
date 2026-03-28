<x-admin.layout title="Create Property">
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        @include('admin.properties.form', [
            'action' => route('admin.properties.store'),
            'method' => 'POST',
        ])
    </div>
</x-admin.layout>
