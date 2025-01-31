<?php

namespace App\Services\User\DomainService;

use App\Models\User;
use App\Services\User\ValueObject\Email;

class ExistEmail
{
    /**
     * @param Email $email
     * @return bool
     */
    public static function execute(Email $email): bool
    {
        return User::query()->where('email', $email->value())->exists();
    }
}
