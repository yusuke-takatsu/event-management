<?php

namespace App\Services\User\Entity;

use App\Enums\User\UserStatus;
use App\Services\User\ValueObject\Email;

class User
{
    /**
     * @param int|null $id
     * @param Email $email
     * @param string $password
     * @param UserStatus $status
     */
    private function __construct(
        public readonly ?int $id,
        public readonly Email $email,
        public readonly string $password,
        public readonly UserStatus $status,
    ) {}

    /**
     * @param Email $email
     * @param string $password
     * @return self
     */
    public static function createInitialUser(Email $email, string $password): self
    {
        return new self(
            id: null,
            email: $email,
            password: $password,
            status: UserStatus::PROVISIONAL_MEMBER(),
        );
    }
}
