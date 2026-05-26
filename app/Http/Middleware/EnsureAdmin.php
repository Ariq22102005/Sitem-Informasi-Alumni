<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdmin
{
    /**
     * Only allow authenticated users with role = admin.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && ($user->role ?? null) === 'admin') {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Akses admin ditolak.');
    }
}

