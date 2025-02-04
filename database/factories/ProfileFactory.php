<?php

namespace Database\Factories;

use App\Services\Profile\ValueObject\DateOfBirth;
use App\Services\Profile\ValueObject\FishingStartedDate;
use App\Services\Profile\ValueObject\Image;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nick_name' => $this->faker->name(),
            'date_of_birth' => new DateOfBirth(CarbonImmutable::now()->format('Y-m-d')),
            'fishing_started_date' => new FishingStartedDate(CarbonImmutable::now()->format('Y-m-d')),
            'image' => new Image($this->faker->filePath()),
        ];
    }
}
