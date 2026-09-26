<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')->group(base_path('routes/auth.php'));
            Route::middleware('web')->group(base_path('routes/admin.php'));
            Route::middleware('web')->group(base_path('routes/formateur.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'formateur' => \App\Http\Middleware\FormateurMiddleware::class,
            'guest.admin' => \App\Http\Middleware\RedirectIfAdmin::class,
            'guest.formateur' => \App\Http\Middleware\RedirectIfFormateur::class,
        ]);

        $middleware->redirectGuestsTo(function ($request) {
            if ($request->is('admin/*') || $request->is('admin')) {
                return route('admin.login');
            }
            if ($request->is('formateur/*') || $request->is('formateur')) {
                return route('formateur.login');
            }
            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();