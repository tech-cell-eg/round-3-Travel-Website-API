<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // Handle validation errors
        $exceptions->render(function (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        });

        // Handle model not found or 404s
        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Resource not found.',
            ], 404);
        });

        // Handle other exceptions
        $exceptions->render(function (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(), // Use generic message in production
            ], 500);
        });

    })->create();
