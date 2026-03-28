<x-admin.layout title="Users & Permissions">
    <p class="mb-4 text-sm text-slate-600">Assign role-based permissions for sub-admin access.</p>

    <div class="space-y-4">
        @foreach ($users as $user)
            <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="mb-4 flex items-start justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">{{ $user->name }}</h2>
                        <p class="text-sm text-slate-500">{{ $user->email }}</p>
                    </div>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-700">{{ $user->role }}</span>
                </div>

                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <label class="block space-y-2">
                        <span class="text-sm font-medium text-slate-700">Role</span>
                        <select name="role" class="w-full max-w-xs rounded-xl border border-slate-200 px-4 py-2.5">
                            <option value="admin" @selected($user->role === 'admin')>Admin (full access)</option>
                            <option value="sub_admin" @selected($user->role === 'sub_admin')>Sub-admin (permission based)</option>
                        </select>
                    </label>

                    <div>
                        <p class="mb-2 text-sm font-medium text-slate-700">Sub-admin Permissions</p>
                        <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($permissionLabels as $key => $label)
                                <label class="flex items-start gap-2 rounded-lg border border-slate-200 p-3 text-sm text-slate-700">
                                    <input
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{ $key }}"
                                        class="mt-0.5"
                                        @checked(in_array('*', $user->permissions ?? [], true) || in_array($key, $user->permissions ?? [], true))
                                    >
                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-500">Save Permissions</button>

                        @if ($user->id !== auth()->id())
                            <button
                                type="submit"
                                form="revoke-{{ $user->id }}"
                                class="rounded-xl border border-red-200 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-50"
                            >
                                Revoke Admin Access
                            </button>
                        @endif
                    </div>
                </form>

                @if ($user->id !== auth()->id())
                    <form id="revoke-{{ $user->id }}" method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Revoke admin access for this user?');" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
            </article>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</x-admin.layout>
