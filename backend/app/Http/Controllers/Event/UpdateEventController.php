<?php

declare(strict_types=1);

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\UpdateEventRequest;
use App\UseCase\Event\UpdateEventUseCase;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateEventController extends Controller
{
    /**
     * @param  UpdateEventUseCase  $updateEventUseCase
     */
    public function __construct(
        private readonly UpdateEventUseCase $updateEventUseCase
    ) {
    }

    /**
     * イベント更新
     *
     * @param  UpdateEventRequest  $request
     * @param  string  $eventId
     * @return JsonResponse
     */
    public function __invoke(UpdateEventRequest $request, string $eventId): JsonResponse
    {
        $this->updateEventUseCase->execute($eventId, $request->getParams());

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
