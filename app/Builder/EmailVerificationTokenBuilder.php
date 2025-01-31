<?php

namespace App\Builder;

use App\Models\EmailVerificationToken;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class EmailVerificationTokenBuilder extends Builder
{
    /**
     * @param int $userId
     * @param int $minutes
     * @return EmailVerificationToken
     */
    public function updateOrCreateToken(int $userId, int $minutes = 60): EmailVerificationToken
    {
        return EmailVerificationToken::updateOrCreate([
            'user_id' => $userId,
        ],
            [
                'token' => Str::random(40),
                'expires_at' => CarbonImmutable::now()->addMinutes($minutes),
            ]);
    }
}
