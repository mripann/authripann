<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed $roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah pengguna sudah login dan memiliki salah satu peran dalam $roles
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
