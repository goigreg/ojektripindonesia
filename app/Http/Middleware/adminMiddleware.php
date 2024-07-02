<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->is_admin == 1) {
            return $next($request);
        } elseif (auth()->check() && auth()->user()->is_admin == 0) {
            Alert::toast('Access denied, you are not admin!', 'error');
            return redirect('/');
        }
        Alert::toast('Access denied, please login!', 'error');
        return redirect('/admin');
    }
}
