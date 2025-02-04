<?php

namespace App\Services\Profile\DomainService;

use App\Models\Profile;

class ExistProfile
{
    /**
     * @param int $userId
     * @return bool
     */
    public static function execute(int $userId): bool
    {
        return Profile::query()->where('user_id', $userId)->exists();
    }
}
