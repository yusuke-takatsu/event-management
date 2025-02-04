<?php

namespace App\Data\Input\Profile;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class StoreInputData extends Data
{
    /**
     * @param string $nickName
     * @param string $dateOfBirth
     * @param string $fishingStartedDate
     * @param UploadedFile|null $image
     */
    public function __construct(
        public readonly string $nickName,
        public readonly string $dateOfBirth,
        public readonly string $fishingStartedDate,
        public readonly ?UploadedFile $image = null
    ) {}
}
