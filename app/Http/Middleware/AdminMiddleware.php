<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin')->user();
        if (!$user || !method_exists($user, 'isAdmin') || !$user->isAdmin()) {
            abort(403, 'Unauthorized.');
        }
        return $next($request);
    }
}
