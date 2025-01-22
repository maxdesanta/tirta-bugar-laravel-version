<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Middleware checkAuth dijalankan'); // Debugging

        if (!Auth::guard('web')->check()) {
            Log::warning('Pengguna belum login, diarahkan ke /login');
            return redirect('/login');
        }

        return $next($request);
    }
}
