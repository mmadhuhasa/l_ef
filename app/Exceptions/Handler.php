<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Exceptions\customException;
use Log;
use Bugsnag;

class Handler extends ExceptionHandler {

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
	HttpException::class,
	ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $ex
     * @return void
     */
    public function report(Exception $ex) {
	return parent::report($ex);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $ex
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $ex) {
	if ($ex instanceof ModelNotFoundException) {
	    $ex = new NotFoundHttpException($ex->getMessage(), $ex);
	}

	if ($ex instanceof customException) {
//             $ex = new customException($ex->getMessage(), $ex);
	    Log::info('Message: ' . $ex->getMessage() . ' customException Line No: ' . $ex->getLine());
	    Bugsnag::notifyException('NotFoundHttpException: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    return response()->view('errors.503', [], 500);
	}

	if ($ex instanceof \Illuminate\Session\TokenMismatchException) {
	    Log::info('Message: ' . $ex->getMessage() . ' TokenMismatchException Line No: ' . $ex->getLine());
	    return response()->view('errors.503', [], 500);
	}

	if ($ex instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
	    Log::info('Message: ' . $ex->getMessage() . ' NotFoundHttpException Line No: ' . $ex->getLine());
	    Bugsnag::notifyException('NotFoundHttpException: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    return response()->view('errors.503', [], 500);
	}

	if ($ex instanceof ExceptionHandler) {
	    Log::info('Message: ' . $ex->getMessage() . ' ExceptionHandler Line No: ' . $ex->getLine());
	    return response()->view('errors.503', [], 500);
	}
	if ($ex instanceof Exception) {
	    Log::info('Message: ' . $ex->getMessage() . ' Exception Line No: ' . $ex->getLine());
	    return response()->view('errors.503', [], 500);
	}

	if ($ex instanceof Tymon\JWTAuth\Exceptions\TokenExpiredException) {
	     Log::info('Message: ' . $ex->getMessage() . ' Exception Line No: ' . $ex->getLine());
	   return response()->view('errors.503', [], 500);
	} 
	if ($ex instanceof Tymon\JWTAuth\Exceptions\TokenInvalidException) {
	     Log::info('Message: ' . $ex->getMessage() . ' Exception Line No: ' . $ex->getLine());
	    return response()->view('errors.503', [], 500);
	}
	
	if ($ex instanceof Tymon\JWTAuth\Exceptions\JWTException) {
	     Log::info('Message: ' . $ex->getMessage() . ' Exception Line No: ' . $ex->getLine());
	    return response()->view('errors.503', [], 500);
	}
	
	return parent::render($request, $ex);
    }

}
