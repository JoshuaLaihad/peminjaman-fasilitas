<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if user is authenticated
        if (!$user) {
            return redirect('/login');
        }

        // Check for admin prefix and role
        if ($request->is('admin/*') && $user->role !== 'admin') {
            return redirect('/')->with('error', 'You do not have access to this page.');
        }

        // Check for user prefix and role
        if ($request->is('user/*') && $user->role !== 'user') {
            return redirect('/')->with('error', 'You do not have access to this page.');
        }

        return $next($request);
    }
}
