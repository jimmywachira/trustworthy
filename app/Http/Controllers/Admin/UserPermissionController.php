<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\AdminPermissions;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPermissionController extends Controller
{
    /**
     * Display admin and sub-admin users.
     */
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::query()
                ->orderByDesc('is_admin')
                ->orderBy('name')
                ->paginate(20),
            'permissionLabels' => AdminPermissions::labels(),
        ]);
    }

    /**
     * Update role and permissions for a user.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role' => ['required', 'in:admin,sub_admin'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ]);

        $permissions = collect($validated['permissions'] ?? [])
            ->filter(fn (string $permission): bool => AdminPermissions::exists($permission))
            ->values()
            ->all();

        $currentUserId = Auth::id();

        if ($user->getKey() === $currentUserId && $validated['role'] !== 'admin') {
            return redirect()->route('admin.users.index')->with('status', 'You cannot remove your own full admin role.');
        }

        $isAdmin = $validated['role'] === 'admin';

        $user->update([
            'role' => $validated['role'],
            'is_admin' => true,
            'permissions' => $isAdmin ? ['*'] : $permissions,
        ]);

        return redirect()->route('admin.users.index')->with('status', 'User role and permissions updated.');
    }

    /**
     * Revoke admin access.
     */
    public function destroy(User $user): RedirectResponse
    {
        $currentUserId = Auth::id();

        if ($user->getKey() === $currentUserId) {
            return redirect()->route('admin.users.index')->with('status', 'You cannot revoke your own admin access.');
        }

        $user->update([
            'is_admin' => false,
            'role' => 'user',
            'permissions' => null,
        ]);

        return redirect()->route('admin.users.index')->with('status', 'Admin access revoked for user.');
    }
}
