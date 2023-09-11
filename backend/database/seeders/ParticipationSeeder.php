<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Participation;
use App\Models\User;
use Illuminate\Database\Seeder;

class ParticipationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->insertParticipations();
    }

    /**
     * イベント参加データ生成
     *
     * @return void
     */
    private function insertParticipations(): void
    {
        $userIds = User::select(['id'])->pluck('id');
        $eventIds = Event::select(['id'])->pluck('id');

        $participations = [];

        foreach ($userIds as $userId) {
            $userEventIds = $eventIds->take(rand(1, 3));

            foreach ($userEventIds as $eventId) {
                $participation = Participation::factory()->make([
                    'user_id' => $userId,
                    'event_id' => $eventId,
                ]);
                $participations[] = $participation->toArray();
            }
        }

        Participation::insert($participations);
    }
}
