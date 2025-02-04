<?php

namespace App\Services\Profile\ValueObject;

use Carbon\CarbonImmutable;
use InvalidArgumentException;

class FishingStartedDate
{
    private CarbonImmutable $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $date = CarbonImmutable::createFromFormat('Y-m-d', $value);

        if ($date->isFuture()) {
            throw new InvalidArgumentException('釣りを始めた日は未来に設定できません。');
        }

        $this->value = $date;
    }

    /**
     * @return CarbonImmutable
     */
    public function value(): CarbonImmutable
    {
        return $this->value;
    }
}
