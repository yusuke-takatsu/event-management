<?php

namespace App\Exceptions;

use App\Http\Resources\Common\AccessDeniedExceptionResource;
use App\Http\Resources\Common\BadRequestExceptionResource;
use App\Http\Resources\Common\NotFoundExceptionResource;
use App\Http\Resources\Common\UnauthorizedExceptionResource;
use App\Http\Resources\Common\ValidationExceptionResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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

        });

        $this->renderFromBadRequest();
        $this->renderFromUnauthorized();
        $this->renderFromForbidden();
        $this->renderFromNotFound();
        $this->renderFromValidationException();   
    }

    /**
     * @return void
     */
    private function renderFromBadRequest(): void
    {
        $this->renderable(function (BadRequestHttpException $e, Request $request) {
            return new BadRequestExceptionResource($e);
        });
    }

    /**
     * @return void
     */
    private function renderFromUnauthorized(): void
    {
        $this->renderable(function (UnauthorizedException|AuthenticationException $e, Request $request) {
            return new UnauthorizedExceptionResource($e);
        });
    }

    /**
     * @return void
     */
    private function renderFromForbidden(): void
    {
        $this->renderable(function (AccessDeniedHttpException $e, Request $request) {
            return new AccessDeniedExceptionResource($e);
        });
    }

    /**
     * @return void
     */
    private function renderFromNotFound(): void
    {
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            return new NotFoundExceptionResource($e);
        });
    }

    /**
     * @return void
     */
    private function renderFromValidationException(): void
    {
        $this->renderable(function (ValidationException $e, Request $request) {
            return new ValidationExceptionResource($e);
        });
    }

    /**
     * {@inheritDoc}
     */
    protected function convertExceptionToArray(Throwable $exception): array
    {
        // すでに特定の例外は renderable で処理されているため、
        // ここでは未処理の例外に対するレスポンスを定義します。
        return [
            'message' => '予期せぬエラーが発生しました。',
            'errors' => [],
        ];
    }
}
