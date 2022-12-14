<?php

namespace App\Exceptions;

use App\Http\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    use ApiResponseTrait;

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

    public function render($request, Throwable $e)
    {
        if ($e instanceof NotFoundHttpException) {
            return $this->apiResponse(404, $request->url() . ' Not Found , Try Again With Correct Url');
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->apiResponse(405, $request->method() . ' Not Allowed Here , Try Again With Correct Method');
        }

        if ($e instanceof ValidationException) {
            return $this->apiResponse(422, 'Validation Error', $e->errors());
        }
    }

}
