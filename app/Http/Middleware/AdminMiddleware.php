<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || (!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('super-admin'))) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
