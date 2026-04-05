<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect('/login');
        }

        $user = \Illuminate\Support\Facades\Auth::user();

        // Case-insensitive check
        $userRole = strtolower($user->role);
        $roles = array_map('strtolower', $roles);

        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }

}
