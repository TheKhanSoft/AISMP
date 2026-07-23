<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (setting('maintenance_mode', false)) {
            // Allow admins to bypass maintenance mode
            if (auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))) {
                return $next($request);
            }

            // Exclude maintenance route itself if we had one, but we can just throw a 503
            abort(503, setting('maintenance_message', 'Site is under maintenance. Please check back later.'));
        }

        return $next($request);
    }
}
