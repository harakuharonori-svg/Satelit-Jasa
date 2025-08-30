<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictAdminFromFreelancer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika user adalah admin
        if (auth()->check() && auth()->user()->role === 'ADMIN') {
            // Redirect admin ke halaman yang sesuai dengan pesan
            return redirect('/')->with('error', 'Fitur ini khusus untuk freelancer. Sebagai admin, Anda dapat mengelola platform melalui menu admin.');
        }

        return $next($request);
    }
}
