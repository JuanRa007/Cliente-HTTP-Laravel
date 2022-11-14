<?php

namespace App\Exceptions;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use Throwable;

class Handler extends ExceptionHandler
{
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e) {
            return $this->handleException($e);
        });
    }

    public function handleException(Throwable $e)
    {

        if ($e instanceof ClientException) {
            return $this->handleClientException($e);
        }
    }


    public function render($request, $exception)
    {
        if ($exception instanceof ClientException) {
            return $this->handleClientException($exception, $request);
        }

        return parent::render($request, $exception);
    }


    protected function handleClientException(ClientException $e)
    {
        $request = $this->request;
        $code = $e->getCode();

        $reponse = json_decode($e->getResponse()->getBody()->getContents());
        $errorMessage = $reponse->error;

        switch ($code) {
            case Response::HTTP_UNAUTHORIZED:
                $request->session()->invalidate();

                if ($request->user()) {
                    Auth::logout();

                    return redirect()
                        ->route('welcome')
                        ->withErrors([
                            'message' => 'The authentication failed. Please, login again.'
                        ]);
                }
                //throw new \Exception("Error Authenticating request. Train again.", 0, $e);
                abort(500, "Error Authenticating request. Train again.");

            default:
                return redirect()->back()->withErrors(['message' => $errorMessage]);
        }
    }
}
