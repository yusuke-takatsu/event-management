<?php

declare(strict_types=1);

namespace App\UseCase\Event;

use App\Repositories\Event\EventRepository;
use Illuminate\Support\Collection;

class FetchEventListUseCase
{
    /**
     * @param  EventRepository  $eventRepository
     */
    public function __construct(
        private readonly EventRepository $eventRepository,
    ) {
    }

    /**
     * イベント一覧取得
     *
     * @return void
     */
    public function execute(): Collection
    {
        $select = [
            'id',
            'title',
            'description',
            'event_date',
            'event_time',
        ];

        return $this->eventRepository->get($select);
    }
}
