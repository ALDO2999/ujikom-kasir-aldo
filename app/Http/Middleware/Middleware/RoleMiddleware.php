<?php

namespace App\Http\Middleware\Middleware;

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

        if (!auth()->check() || auth()->user()->role !== $role) {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
        }

        // $user = auth()->user();

        return $next($request);
    }
}
    