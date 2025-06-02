<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles)
    {
        // Split roles dengan tanda '-'
        $rolesArray = explode('-', $roles);
        $user = $request->user();

        if (!$user || !in_array($user->role, $rolesArray)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
