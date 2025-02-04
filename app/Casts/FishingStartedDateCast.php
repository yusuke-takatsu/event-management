<?php

namespace App\Casts;

use App\Services\Profile\ValueObject\FishingStartedDate;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class FishingStartedDateCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return new FishingStartedDate($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value instanceof FishingStartedDate) {
            return $value->value()->toDateString();
        }

        throw new InvalidArgumentException(sprintf('%s以外の値は設定できません。', FishingStartedDate::class));
    }
}
