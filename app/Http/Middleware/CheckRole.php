<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check() || !in_array(strtolower(auth()->user()->role->role), array_map('strtolower', $roles))) {
            abort(403, 'Akses tidak diizinkan.');
        }

        return $next($request);
    }
}
