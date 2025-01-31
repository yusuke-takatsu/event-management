<?php

namespace App\Data\Input\Auth;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class RegisterInputData extends Data
{
    /**
     * @param string $email
     * @param string $password
     * @param bool $passwordConfirmation
     */
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly bool $passwordConfirmation,
    ) {}
}
