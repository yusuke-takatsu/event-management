<?php

declare(strict_types=1);

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\UseCase\Event\FetchEventListUseCase;
use Illuminate\Http\JsonResponse;

class FetchEventListController extends Controller
{
    /**
     * @param  FetchEventListUseCase  $fetchEventListUseCase
     */
    public function __construct(
        private readonly FetchEventListUseCase $fetchEventListUseCase,
    ) {
    }

    /**
     * 一覧取得
     */
    public function __invoke(): JsonResponse
    {
        $events = $this->fetchEventListUseCase->execute();

        return response()->json($events);
    }
}
