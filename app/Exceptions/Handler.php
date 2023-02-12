<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        $this->renderable(function (\Exception $e) {
            $statusCode = 404;
            $title = trans('exception.error.title');
            $message = trans('exception.error.message');
            $type = "exception";

            if ($e instanceof AuthenticationException) {
                $statusCode = 401;
                $title = trans('exception.401.title');
                $message = trans('exception.401.message');
            }
            if ($e instanceof ThrottleRequestsException) {
                $title = trans('exception.throttle_requests.title');
                $message = trans('exception.throttle_requests.message', ['minute' => 1]);
                $statusCode = 429;
                $type = "throttle";
            }
            if ($e instanceof QueryException) {
                $title = trans('exception.query_exception.title');
                $message = trans('exception.query_exception.message');
                $statusCode = 404;
            }

            if ($e instanceof NotFoundHttpException) {
                $statusCode = 404;
                $title = trans('exception.not_found.title');
                $message = trans('exception.not_found.message');
            }
            if ($e instanceof \ErrorException) {
                $statusCode = 404;
                $title = trans('exception.error.title');
                $message = trans('exception.error.message');
            }
            if ($e instanceof MethodNotAllowedHttpException) {
                $statusCode = 404;
                $title = trans('exception.allowed_http.title');
                $message = trans('exception.allowed_http.message');
            }
            \Log::error('api-error-handler', ['message' => $e->getMessage()]);

            return response()->json(['title' => $title, 'message' => $message, 'success' => false, 'type' => $type]);
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            $json = [
                'status' => false,
                'message' => "unauthenticated"
            ];
            return response()
                ->json($json, 401);
        }

    }
}
