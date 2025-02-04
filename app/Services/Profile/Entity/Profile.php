<?php

namespace App\Services\Profile\Entity;

use App\Services\Profile\ValueObject\DateOfBirth;
use App\Services\Profile\ValueObject\FishingStartedDate;

class Profile
{
    /**
     * @param int|null $id
     * @param string $nickName
     * @param DateOfBirth $dateOfBirth
     * @param FishingStartedDate $fishingStartedDate
     * @param string|null $image
     */
    public function __construct(
        public readonly ?int $id,
        public readonly string $nickName,
        public readonly DateOfBirth $dateOfBirth,
        public readonly FishingStartedDate $fishingStartedDate,
        public readonly ?string $image,
    ) {}
}
