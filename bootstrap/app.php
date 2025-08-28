<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (AuthenticationException $e, Request $request) {
            if ($request->is('admin') || $request->is('admin/*')) {
                return redirect()->guest(route('filament.admin.auth.login'));
            }

            if ($request->is('client') || $request->is('client/*')) {
                return redirect()->guest(route('filament.client.auth.login'));
            }

            return redirect()->guest(route('filament.admin.auth.login'));
        });
    })->create();
