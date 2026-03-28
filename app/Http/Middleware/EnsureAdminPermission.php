<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();

        if (! $user || ! $user->canAccessAdminPanel() || ! $user->hasPermission($permission)) {
            abort(403, 'Permission denied for this admin action.');
        }

        return $next($request);
    }
}
