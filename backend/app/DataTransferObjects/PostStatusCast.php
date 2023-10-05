<?php

namespace App\DataTransferObjects;

use App\Enums\PostStatus;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class PostStatusCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): PostStatus
    {
        return PostStatus::fromValue($value);
    }
}