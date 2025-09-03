<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        // Skip for admin users
        if ($user && $user->role === 'admin') {
            return $next($request);
        }
        
        // Skip for logout route
        if ($request->route() && $request->route()->getName() === 'logout') {
            return $next($request);
        }
        
        // Check if profile is completed for regular users
        if ($user && $user->role === 'pengguna') {
            if (!($user->profile && $user->profile->is_profile_completed)) {
                return redirect()->route('profile.complete.form')
                    ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu.');
            }
        }
        
        return $next($request);
    }
}
