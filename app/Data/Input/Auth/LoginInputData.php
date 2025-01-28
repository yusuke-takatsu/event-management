<?php

namespace App\Data\Input\Auth;

use Spatie\LaravelData\Data;

class LoginInputData extends Data
{
    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(
      public readonly string $email,
      public readonly string $password,
      public readonly bool $remember = false,
    ) {}

    public function onlyEmailAndPassword(): array
    {
        $only = [
            'email',
            'password',
        ];

        return $this->only(...$only)->toArray();
    }
}
