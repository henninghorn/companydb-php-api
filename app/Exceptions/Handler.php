<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ValidationException)
        {
            $data = [
                'error' => $e->getMessage(),
                'fields' => $e->validator->getMessageBag()
            ];

            return response()->json($data, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof NotFoundHttpException)
        {
            $data = [
                'error' => 'Route not found'
            ];

            return response()->json($data, Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof ModelNotFoundException)
        {
            $data = [
                'error' => 'Resource not found'
            ];

            return response()->json($data, Response::HTTP_NOT_FOUND);
        }

        return parent::render($request, $e);
    }
}
