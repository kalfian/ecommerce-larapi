<?php

namespace App\Exceptions;

use Exception;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($request->expectsJson()){
            if($exception instanceof NotFoundHttpException){
                return response()->json([
                    'errors' => 'Route error'
                ],Response::HTTP_NOT_FOUND);
            }
        }

        if($request->expectsJson()){
            if($exception instanceof ModelNotFoundHttpException){
                return response()->json([
                    'errors' => 'Product Model Not Found'
                ],Response::HTTP_NOT_FOUND);
            }
        }
        return parent::render($request, $exception);
    }
}
