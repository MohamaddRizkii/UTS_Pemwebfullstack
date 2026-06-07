<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, \Closure $next)
    {
        // Cek apakah user sudah login dan mempunyai role 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, kembalikan response JSON error
        return response()->json([
            'success' => false,
            'message' => 'Akses ditolak! Anda bukan Admin.'
        ], 403);
    }
}
