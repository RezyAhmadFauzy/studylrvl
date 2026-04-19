<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || $user->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Akses ini hanya untuk administrator.');
        }

        return $next($request);
    }
}
