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

    /**
     * 作成
     *
     * @param  array  $params
     * @return void
     */
    public function create(array $params): void;

    /**
     * 更新
     *
     * @param string $eventId
     * @param array $params
     * @return void
     */
    public function update(string $eventId, array $params): void;
}
