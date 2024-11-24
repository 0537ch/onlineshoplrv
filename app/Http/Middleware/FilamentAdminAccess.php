<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilamentAdminAccess
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna login dan memiliki role admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika tidak admin, arahkan ke halaman lain atau tampilkan pesan
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}

