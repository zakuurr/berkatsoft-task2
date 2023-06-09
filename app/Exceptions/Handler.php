<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use BadMethodCallException;
use ErrorException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            if($exception instanceof NotFoundHttpException){
                return $this->apiResponse(
                    [
                        'success'   => false,
                        'name'      => 'Not Found HTTP Exception',
                        'message'   => 'The resource that you requested not found',
                        'error_code'=> 404,
                        'error' => true,
                        'exception' =>$exception
                    ],404
                );
            }

            if($exception instanceof MethodNotAllowedHttpException){
                return $this->apiResponse(
                    [
                        'success'   => false,
                        'name'      => 'Method Not Allowed HTTP Exception',
                        'message'   => 'The method that you requested is not allowed on this route',
                        'error_code'=> 403,
                        'error' => true,
                        'exception' =>$exception
                    ],403
                );
            }

            if($exception instanceof ErrorException){
                return $this->apiResponse(
                    [
                        'success'   => false,
                        'name'      => 'Error Exception',
                        'message'   => 'There is internal error',
                        'error_code'=> 500,
                        'exception' =>$exception
                    ],500
                );
            }

            if($exception instanceof BadMethodCallException){
                return $this->apiResponse(
                    [
                        'success'   => false,
                        'name'      => 'Bad Method Call Exception',
                        'message'   => 'There is internal error',
                        'error_code'=> 500,
                        'error' => true,
                        'exception' =>$exception
                    ],500
                );
            }

            // if ($exception instanceof PostTooLargeException) {
            //     return $this->apiResponse(
            //         [
            //             'success' => false,
            //             'message' => "Size of attached file should be less " . ini_get("upload_max_filesize") . "B"
            //         ],
            //         400
            //     );
            // }

            if ($exception instanceof AuthenticationException) {
                return $this->apiResponse(
                    [
                        'success'   => false,
                        'name'      => 'Authentication Exception',
                        'message'   => 'Unauthenticated or Token Expired, Please Login',
                        'error_code'=> 401,
                        'error' => true,
                        'exception' =>$exception
                    ],
                    401
                );
            }

            // if ($exception instanceof ThrottleRequestsException) {
            //     return $this->apiResponse(
            //         [
            //             'success' => false,
            //             'message' => 'Too Many Requests,Please Slow Down'
            //         ],
            //         429
            //     );
            // }

            // if ($exception instanceof ModelNotFoundException) {
            //     return $this->apiResponse(
            //         [
            //             'success' => false,
            //             'message' => 'Entry for ' . str_replace('App\\', '', $exception->getModel()) . ' not found'
            //         ],
            //         404
            //     );
            // }

            // if ($exception instanceof ValidationException) {
            //     return $this->apiResponse(
            //         [
            //             'success' => false,
            //             'message' => $exception->getMessage(),
            //             'errors' => $exception->errors()
            //         ],
            //         422
            //     );
            // }

            // if ($exception instanceof QueryException) {

            //     return $this->apiResponse(
            //         [
            //             'success' => false,
            //             'message' => 'There was Issue with the Query',
            //             'exception' => $exception

            //         ],
            //         500
            //     );
            // }
            // // if ($exception instanceof HttpResponseException) {
            // //     // $exception = $exception->getResponse();
            // //     return $this->apiResponse(
            // //         [
            // //             'success' => false,
            // //             'message' => "There was some internal error",
            // //             'exception'  => $exception
            // //         ],
            // //         500
            // //     );
            // // }
            if ($exception instanceof \Error) {
                return $this->apiResponse(
                    [
                        'success'   => false,
                        'name'      => 'Authentication Exception',
                        'message' => "There was some internal error",
                        'error_code'=> 500,
                        'error' => true,
                        'exception' =>$exception
                    ],
                    500
                );
            }
        }


        return parent::render($request, $exception);
    }

}
