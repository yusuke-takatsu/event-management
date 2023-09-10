<?php

declare(strict_types=1);

namespace App\UseCase\Event;

use App\Repositories\Event\EventRepository;
use Illuminate\Support\Facades\Auth;

class StoreEventUseCase
{
    /**
     * @param  EventRepository  $eventRepository
     */
    public function __construct(
        private readonly EventRepository $eventRepository
    ) {
    }

    /**
     * イベント作成
     *
     * @param  array  $params
     * @return void
     */
    public function execute(array $params): void
    {
        $user = Auth::user();

        $params['user_id'] = $user->id;

        $this->eventRepository->create($params);
    }
}
