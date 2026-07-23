<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\MemberMiddleware;
use App\Http\Middleware\MaintenanceMode;
use App\Providers\SettingsServiceProvider;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withProviders([
        SettingsServiceProvider::class,
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'member' => MemberMiddleware::class,
            'maintenance' => MaintenanceMode::class,
        ]);
        $middleware->append(MaintenanceMode::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
