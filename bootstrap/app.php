<?php

use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isApoteker;
use App\Http\Middleware\isDokter;
use App\Http\Middleware\isPasien;
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
        $middleware->alias([
            'admin' => isAdmin::class,
            'dokter' => isDokter::class,
            'pasien' => isPasien::class,
            'apoteker' => isApoteker::class,
        ]);
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
