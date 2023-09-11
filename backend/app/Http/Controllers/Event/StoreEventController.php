<?php

declare(strict_types=1);

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreEventRequest;
use App\UseCase\Event\StoreEventUseCase;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreEventController extends Controller
{
    /**
     * @param  StoreEventUseCase  $storeEventUseCase
     */
    public function __construct(
        private readonly StoreEventUseCase $storeEventUseCase
    ) {
    }

    /**
     * イベントを登録
     *
     * @param  StoreEventRequest  $request
     * @return JsonResponse
     */
    public function __invoke(StoreEventRequest $request): JsonResponse
    {
        $this->storeEventUseCase->execute($request->getParams());

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
