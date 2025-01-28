<?php declare(strict_types=1);

namespace App\Enums\User;

use BenSampo\Enum\Enum;

/**
 * @method static static GUEST()
 * @method static static MEMBER()
 * @method static static WITHDRAWN()
 */
final class UserStatus extends Enum
{
    public const GUEST = 0;

    public const MEMBER = 1; // 会員

    public const WITHDRAWN = 2; // 退会
}
