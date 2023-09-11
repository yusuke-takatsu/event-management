<?php

declare(strict_types=1);

namespace App\UseCase\Event;

use App\Repositories\Event\EventRepository;
use Illuminate\Support\Facades\Auth;

class UpdateEventUseCase
{
    /**
     * @param EventRepository $eventRepository
     */
    public function __construct(
      private readonly EventRepository $eventRepository
    )
    {
    }

    /**
     * イベント更新
     *
     * @param string $eventId
     * @param array $params
     * @return void
     */
    public function execute(string $eventId, array $params)
    {
        $user = Auth::user();
        
        $params['user_id'] = $user->id;

        $this->eventRepository->update($eventId, $params);
    }
}