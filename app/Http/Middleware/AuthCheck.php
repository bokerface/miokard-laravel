<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if user role is admin
        if (auth()->check() && auth()->user()->role_id == 1) {
            # code...
        }

        // if user role is student
        if (auth()->check() && auth()->user()->role_id == 2) {
            return redirect()->to(route('student.dashboard'));
        }

        // if user role is teacher
        if (auth()->check() && auth()->user()->role_id == 3) {
            return redirect()->to(route('teacher.dashboard'));
        }

        return $next($request);
    }
}
