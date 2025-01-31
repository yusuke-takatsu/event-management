<?php

namespace App\Http\UseCase\Auth;

use App\Data\Input\Auth\LoginInputData;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginUseCase
{
    private const LOGIN_FAILURE_COUNT = 5;

    private const LOGIN_LOCK_MINUTES = 15 * 60;

    /**
     * @param LoginInputData $input
     * @return void
     */
    public function execute(LoginInputData $input): void
    {
        $this->authenticate($input);
        session()->regenerate();
    }

    /**
     * @param LoginInputData $input
     * @return void
     */
    public function authenticate(LoginInputData $input): void
    {
        $this->ensureIsNotRateLimited($input);

        if (! Auth::guard('user')->attempt($input->onlyEmailAndPassword(), $input->remember)) {
            RateLimiter::hit($this->throttleKey($input), self::LOGIN_LOCK_MINUTES);

            Log::info('ログインに失敗しました', [
                'method' => __METHOD__,
            ]);

            throw new AuthenticationException('ログイン情報が誤っています。');
        }

        RateLimiter::clear($this->throttleKey($input));
    }

    /**
     * レート制限されていないことを確認する
     *
     * @param LoginInputData $input
     * @return void
     */
    private function ensureIsNotRateLimited(LoginInputData $input): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($input), self::LOGIN_FAILURE_COUNT)) {
            return;
        }

        event(new Lockout(request()));

        throw new AuthenticationException('最大ログイン回数を超えています。しばらくしてからログインし直してください。');
    }

    /**
     * レート制限を管理するための一意のキーを生成
     *
     * @param LoginInputData $input
     * @return string
     */
    private function throttleKey(LoginInputData $input): string
    {
        return Str::transliterate(Str::lower($input->email).'|'.request()->ip());
    }
}
