<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    private Collection $users;

    public function __construct()
    {
        $this->users = User::query()->get();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = [];

        $this->users->each(function($user) use(&$profiles) {
            $profile = Profile::factory()->make([
                'user_id' => $user->id,
            ])->toArray();

            $profile['created_at'] = CarbonImmutable::now()->format('Y-m-d H:i:s');
            $profile['updated_at'] = CarbonImmutable::now()->format('Y-m-d H:i:s');

            $profiles[] = $profile;
        });

        Profile::query()->insert($profiles);
    }
}
