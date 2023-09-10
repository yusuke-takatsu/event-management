<?php

declare(strict_types=1);

namespace App\Repositories\Event;

use Illuminate\Database\Eloquent\Collection;

interface EventRepository
{
    /**
     * 一覧取得
     *
     * @param  array  $select
     * @return Collection
     */
    public function get(array $select = ['*']): Collection;
}
