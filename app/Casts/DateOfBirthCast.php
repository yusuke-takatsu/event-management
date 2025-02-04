<?php

namespace App\Casts;

use App\Services\Profile\ValueObject\DateOfBirth;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class DateOfBirthCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return new DateOfBirth($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value instanceof DateOfBirth) {
            return $value->value();
        }

        throw new InvalidArgumentException(sprintf('%s以外の値は設定できません。', DateOfBirth::class));
    }
}
