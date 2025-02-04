<?php

namespace App\Builder;

use App\Models\Profile as ModelsProfile;
use App\Services\Profile\Entity\Profile;
use Illuminate\Database\Eloquent\Builder;

class ProfileBuilder extends Builder
{
    /**
     * @param Profile $profile
     * @return void
     */
    public function createFromEntity(Profile $profile)
    {
        return ModelsProfile::create([
            'nick_name' => $profile->nickName,
            'date_of_birth' => $profile->dateOfBirth,
            'fishing_started_date' => $profile->fishingStartedDate,
            'image' => $profile->image,
        ]);
    }
}
