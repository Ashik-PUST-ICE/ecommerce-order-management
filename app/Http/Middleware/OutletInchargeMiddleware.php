<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OutletInchargeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
