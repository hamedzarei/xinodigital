<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Spatie\MediaLibrary\MediaCollections\Exceptions\RequestDoesNotHaveFile;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

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

        });
    }

    public function render($request, Throwable $e)
    {
        $response = [
            'message' => $e->getMessage(),
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR
        ];

        if ($request->is('api/*')) {
            if ($e instanceof TokenExpiredException) {
                $response['message'] = $e->getMessage();
                $response['status'] = Response::HTTP_UNAUTHORIZED;
            } elseif ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
                $response['message'] = trans('messages.custom.'.Response::HTTP_NOT_FOUND);
                $response['status'] = Response::HTTP_NOT_FOUND;
            } elseif ($e instanceof UnauthorizedException || $e instanceof UnauthorizedHttpException) {
                $response['message'] = trans('messages.custom.'.Response::HTTP_UNAUTHORIZED);
                $response['status'] = Response::HTTP_UNAUTHORIZED;
            } elseif ($e instanceof AccessDeniedHttpException || $e instanceof AuthorizationException) {
                $response['message'] = trans('messages.custom.'.Response::HTTP_FORBIDDEN);
                $response['status'] = Response::HTTP_FORBIDDEN;
            } elseif ($e instanceof BadRequestHttpException || $e instanceof RequestDoesNotHaveFile) {
                $response['message'] = $e->getMessage() ?
                    $e->getMessage() : trans('messages.custom.'.Response::HTTP_BAD_REQUEST);
                $response['status'] = Response::HTTP_BAD_REQUEST;
            }

            return response()->json($response, $response['status']);
        }

        return parent::render($request, $e);
    }
}
