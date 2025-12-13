<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRouteAccess
{
    /**
     * Handle an incoming request - prevent users from accessing admin routes
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return $next($request);
        }

        $user = auth()->user();

        // If accessing admin/* routes but not an admin, redirect to user dashboard
        if ($request->is('admin/*') && !$user->isAdmin()) {
            return redirect()->route('user.dashboard');
        }

        // If accessing user/* routes but not a user, redirect to admin dashboard
        if ($request->is('user/*') && !$user->isUser()) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
