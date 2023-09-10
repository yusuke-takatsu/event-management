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
}
