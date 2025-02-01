<?php

namespace App\Http\UseCase\Auth;

use App\Models\EmailVerificationToken;
use App\Services\User\DomainService\EmailVerifyValidated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmailVerifyUseCase
{
    /**
     * @param string $token
     * @return void
     */
    public function execute(string $token): void
    {
        $emailVeriy = EmailVerificationToken::query()->where('token', $token)->first();

        EmailVerifyValidated::execute($emailVeriy);

        $user = $emailVeriy->user;

        if (is_null($user)) {
            Log::info('user is not found', [
                'method' => __METHOD__,
            ]);

            throw new NotFoundHttpException();
        }

        if ($user->hasVerifiedEmail()) {
            Log::info('already verified', [
                'method' => __METHOD__,
            ]);

            throw ValidationException::withMessages([
                'すでに認証済みです。',
            ]);
        }

        DB::transaction(function () use ($user, $emailVeriy) {
            $user->markEmailAsVerified();

            $emailVeriy->delete();
        });
    }
}
