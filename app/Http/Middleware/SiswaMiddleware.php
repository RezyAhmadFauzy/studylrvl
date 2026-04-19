<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SiswaMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || $user->role !== 'siswa') {
            return redirect()->route('admin.dashboard')->with('error', 'Akses ini hanya untuk siswa.');
        }

        return $next($request);
    }
}
