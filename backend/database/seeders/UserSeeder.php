<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];

        foreach (LazyCollection::range(1, 100) as $id) {
            $user = User::factory()->make([
                'email' => "user$id@mail.com",
                'name' => "user$id",
            ]);

            $users[] = $user->makeVisible(['password', 'remember_token'])->toArray();
        }

        User::insert($users);
    }
}
