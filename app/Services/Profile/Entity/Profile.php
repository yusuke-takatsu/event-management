<?php

namespace App\Services\Profile\Entity;

use App\Services\Profile\ValueObject\DateOfBirth;
use App\Services\Profile\ValueObject\FishingStartedDate;
use App\Services\Profile\ValueObject\Image;

class Profile
{
    /**
     * @param int|null $userId
     * @param string $nickName
     * @param DateOfBirth $dateOfBirth
     * @param FishingStartedDate $fishingStartedDate
     * @param Image|null $image
     */
    public function __construct(
        public readonly int $userId,
        public readonly string $nickName,
        public readonly DateOfBirth $dateOfBirth,
        public readonly FishingStartedDate $fishingStartedDate,
        public readonly ?Image $image,
    ) {}
}
