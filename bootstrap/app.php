<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LocaleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(LocaleMiddleware::class);
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'check.route.access' => \App\Http\Middleware\CheckAdminRouteAccess::class,
        ]);
        
        $middleware->validateCsrfTokens(except: [
            'webhook/midtrans',
        ]);

        // Apply route access check to all web routes
        $middleware->web(append: [
            \App\Http\Middleware\CheckAdminRouteAccess::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
            \Illuminate\Support\Facades\Log::warning('404 Not Found triggered', [
                'url' => request()->fullUrl(),
                'method' => request()->method(),
                'ip' => request()->ip(),
                'user_id' => auth()->id() ?? 'guest',
                'message' => $e->getMessage(),
            ]);
        });
    })->create();
