<?php

declare(strict_types=1);

namespace App\Enums\User;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

/**
 * @method static static GUEST()
 * @method static static PROVISIONAL_MEMBER()
 * @method static static MEMBER()
 * @method static static WITHDRAWN()
 */
final class UserStatus extends Enum
{
    #[Description('ゲスト')]
    public const GUEST = 0;

    #[Description('仮会員')]
    public const PROVISIONAL_MEMBER = 1;

    #[Description('会員')]
    public const MEMBER = 2;

    #[Description('退会')]
    public const WITHDRAWN = 3;
}
