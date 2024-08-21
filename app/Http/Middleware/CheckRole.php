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
            return redirect()->route('login');
        }

        // Check role if specified in the route definition
        if ($role && $user->role !== $role) {
            return redirect('/')->with('error', 'You do not have access to this page.');
        }

        // Check role based on prefix
        if ($request->is('admin/*') && $user->role !== 'admin') {
            return redirect('/')->with('error', 'You do not have access to this page.');
        }

        if ($request->is('user/*') && $user->role !== 'user') {
            return redirect('/')->with('error', 'You do not have access to this page.');
        }

        return $next($request);
    }
}
