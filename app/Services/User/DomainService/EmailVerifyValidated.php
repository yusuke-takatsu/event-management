<?php

namespace App\Services\User\DomainService;

use App\Models\EmailVerificationToken;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmailVerifyValidated
{
    /**
     * @param string|null $token
     * @return void
     */
    public static function execute(?EmailVerificationToken $emailVeriy): void
    {
        if (is_null($emailVeriy)) {
            Log::info('not found is token', [
                'method' => __METHOD__,
            ]);

            throw new NotFoundHttpException();
        }

        if (CarbonImmutable::parse($emailVeriy->expires_at)->isPast()) {
            Log::info('token expiration', [
                'method' => __METHOD__,
            ]);

            throw ValidationException::withMessages([
                'トークンの有効期限が切れています。',
            ]);
        }
    }
}
