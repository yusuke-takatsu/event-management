<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::select(['id'])->pluck('id');

        $this->insertEvent($userIds);
    }

    /**
     * イベントデータ生成
     *
     * @param  Collection  $userIds
     * @return void
     */
    private function insertEvent(Collection $userIds): void
    {
        $events = [];

        foreach ($userIds as $userId) {
            $eventCount = rand(1, 5);

            foreach (range(1, $eventCount) as $_) {
                $event = Event::factory()->make([
                    'user_id' => $userId,
                ]);

                $events[] = $event->toArray();
            }
        }

        Event::insert($events);
    }
}
