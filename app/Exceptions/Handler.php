<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            $name = preg_replace('/(?:\w+\\\\)+(\w+)$/', '$1', get_class($exception));
            $file = preg_replace('/\\\/', '/', str_replace(base_path(), '', $exception->getFile()));
            $message = htmlspecialchars($exception->getMessage());
            $errors = method_exists($exception, 'errors') ? $exception->errors() : ['exception' => $message];

            return json_response(null, -1, 400, $errors, [
                $name => [
                    'message' => $message,
                    'file' => $file,
                    'line' => $exception->getLine(),
                    'code' => $exception->getCode(),
                ],
            ]);
        }

        return parent::render($request, $exception);
    }
}
