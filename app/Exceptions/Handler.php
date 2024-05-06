<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // protected function unauthenticated($request, AuthenticationException $exception)
    // {
    //     if ($request->expectsJson()) {
    //         return response()->json(['status' => 'false',
    //          'message' => 'Authentication required. Please provide valid credentials or authentication token.', 
    //          'code' => Response::HTTP_UNAUTHORIZED, // Use constant for status code
    //     ],
    //         //     [
    //         //     'error' => [
    //         //         'message' => 'Authentication required. Please provide valid credentials or authentication token.',
    //         //         'code' => Response::HTTP_UNAUTHORIZED, // Use constant for status code
    //         //     ]
    //         // ],
    //          Response::HTTP_UNAUTHORIZED);
    //     }

    //     if ($exception instanceof ModelNotFoundException && $request->wantsJson())
    //     {
    //         return response()->json([
    //             'data' => 'Resource not found'
    //         ], 404);
    //     }


    //     return response()->json([
    //         'data' => 'Wrong token provided'
    //     ], 404);
    // }

    protected function unauthenticated($request, AuthenticationException $exception)
{
    if ($request->expectsJson()) {
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication required. Please provide a valid authentication token.',
                'code' => Response::HTTP_UNAUTHORIZED
            ], Response::HTTP_UNAUTHORIZED);
        }
        
        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid authentication token provided.',
                'code' => Response::HTTP_UNAUTHORIZED
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Resource not found.',
            'code' => Response::HTTP_NOT_FOUND
        ], Response::HTTP_NOT_FOUND);
    }

    return response()->json([
        "status" => "false",
        "message" => "Authentication required. Please provide a valid authentication token.",
        "code" => Response::HTTP_UNAUTHORIZED
    ], Response::HTTP_UNAUTHORIZED);
}

}
