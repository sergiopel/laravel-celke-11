<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // acrescentei essa linha abaixo, se não houver autenticação, vai para essa rota
        $middleware->redirectGuestsTo('/');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
