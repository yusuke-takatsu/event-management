<?php

namespace App\Builder;

use App\Models\User as ModelsUser;
use App\Services\User\Entity\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserBuilder extends Builder
{
    /**
     * @param User $user
     * @return ModelsUser
     */
    public function createFromEntity(User $user): ModelsUser
    {
        return ModelsUser::create([
            'email' => $user->email,
            'password' => Hash::make($user->password),
            'status' => $user->status,
        ]);
    }
}
