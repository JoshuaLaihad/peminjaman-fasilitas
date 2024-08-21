<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Check if the request expects JSON
        if ($request->expectsJson()) {
            return null;
        }

        // Check if the user is authenticated
        if (!Auth::check()) {
            return route('login');
        }

        // Get the authenticated user
        $user = Auth::user();

        // Redirect admin trying to access user pages
        if ($user->role == 'admin' && $request->is('user/*')) {
            return redirect()->route('login')->with('failed', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Redirect user trying to access admin pages
        if ($user->role == 'user' && $request->is('admin/*')) {
            return redirect()->route('login')->with('failed', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return route('login');
    }
}
