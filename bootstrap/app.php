<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use app\Http\Middleware\IsAdmin;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            \App\Http\Middleware\Cart::class,
        ]);
   })->withMiddleware(function (Middleware $middleware) {
    $middleware->use([
            \App\Http\Middleware\InfoUser::class,
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
    // ->withMiddleware(function (Middleware $middleware) {
    //     $middleware->append(IsAdmin::class);
    // });

    