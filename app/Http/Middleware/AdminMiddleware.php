<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
