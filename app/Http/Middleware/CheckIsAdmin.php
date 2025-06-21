<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 2. UBAH auth()->check() MENJADI Auth::check()
        // Pengecekan isAdmin() pada $request->user() sudah benar.
        if (Auth::check() && $request->user()->isAdmin()) {
            return $next($request);
        }

        return redirect(route('home'));
    }
}