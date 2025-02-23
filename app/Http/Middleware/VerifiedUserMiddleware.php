<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class VerifiedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Allow admins to proceed regardless of verification
            if (Auth::user()->role === 'admin') {
                return $next($request);
            }
    
            // Only allow verified users to proceed
            if (Auth::user()->verified) {
                return $next($request);
            }
            return redirect()->route('dashboardview')->with('error', 'Your account is not verified.');
        }

        return redirect()->route('loginview');
    }
}
