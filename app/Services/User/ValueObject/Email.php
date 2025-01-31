<?php

namespace App\Services\User\ValueObject;

use InvalidArgumentException;

class Email
{
    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (mb_strlen($value) > 255) {
            throw new InvalidArgumentException('255文字以内でなくてはなりません。');
        }

        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('無効なメールアドレス形式です。');
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param Email $email
     * @return bool
     */
    public function eq(Email $email): bool
    {
        return $this->value === $email->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
