<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated via web guard
        if (! Auth::check()) {
            return redirect()->route('student.login');
        }

        // Check if user has student role
        if (Auth::user()->role !== 'student') {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
