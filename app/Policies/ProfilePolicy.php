<?php

namespace App\Policies;

use App\Enums\User\UserStatus;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProfilePolicy
{
    /**
     * @param Authenticatable $auth
     * @return bool
     */
    public function store(Authenticatable $auth): bool
    {
        if (! $auth instanceof User) {
            return false;
        }

        return $auth->status->is(UserStatus::MEMBER);
    }
}
