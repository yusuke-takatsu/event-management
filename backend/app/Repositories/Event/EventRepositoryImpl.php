<?php

declare(strict_types=1);

namespace App\Repositories\Event;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

class EventRepositoryImpl implements EventRepository
{
    /**
     * {@inheritDoc}
     */
    public function get(array $select = ['*']): Collection
    {
        return Event::select($select)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $params): void
    {
        Event::create($params);
    }

    /**
     * {@inheritDoc}
     */
    public function update(string $eventId, array $params): void
    {
        Event::where('id', $eventId)->update($params);
    }
}
