<?php

use Illuminate\Foundation\Application;
use Illuminate\Session\Middleware\StartSession;
use App\Http\Middleware\CalculateTopUsersActivity;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(CalculateTopUsersActivity::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
