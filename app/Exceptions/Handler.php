<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TypeError;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            Log::debug('[NotFoundHttpException]: ' . $e->getMessage(), [$request]);
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        });
        $this->renderable(function (AccessDeniedHttpException $e, Request $request) {
            Log::debug('[AccessDeniedHttpException]: ' . $e->getMessage(), [$request]);
            return response()->json([
                'message' => 'Forbidden',
            ], 403);
        });
        $this->renderable(function (UniqueConstraintViolationException $e, Request $request) {
            Log::debug('[UniqueConstraintViolationException]: ' . $e->getMessage(), [$request]);
            return response()->json([
                'message' => 'Duplicated Entry',
            ], 422);
        });
        $this->renderable(function (QueryException $e, Request $request) {
            Log::debug('[QueryException]: ' . $e->getMessage(), [$request]);
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        });
        $this->renderable(function (TypeError $e, Request $request) {
            Log::debug('[TypeError]: ' . $e->getMessage(), [$request]);
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        });
        $this->renderable(function (FatalError $e, Request $request) {
            Log::debug('[FatalError]: ' . $e->getMessage(), [$request]);
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        });
    }
}
