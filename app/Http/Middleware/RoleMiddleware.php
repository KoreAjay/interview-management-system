<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // If user has the correct role, allow access
        if ($user->role === $role) {
            return $next($request);
        }

        // Redirect to appropriate dashboard based on user's actual role
        switch ($user->role) {
            case 'admin':
                return redirect('/admin/dashboard')
                    ->with('error', 'Access denied. You do not have permission to access that page.');
            
            case 'interviewer':
                return redirect('/interviewer/dashboard')
                    ->with('error', 'Access denied. You do not have permission to access that page.');
            
            case 'candidate':
                return redirect('/candidate/dashboard')
                    ->with('error', 'Access denied. You do not have permission to access that page.');
            
            default:
                return redirect('/')
                    ->with('error', 'Invalid user role.');
        }
    }
}