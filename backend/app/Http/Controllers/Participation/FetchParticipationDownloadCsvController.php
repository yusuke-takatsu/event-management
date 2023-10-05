<?php

declare(strict_types=1);

namespace App\Http\Controllers\Participation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Participation\FetchParticipationDownloadCsvRequest;
use App\UseCase\Participation\FetchParticipationDownloadCsvUseCase;
use Illuminate\Http\Request;

class FetchParticipationDownloadCsvController extends Controller
{
    /**
     * @param FetchParticipationDownloadCsvUseCase $fetchParticipationDownloadCsvUseCase
     */
    public function __construct(
      private readonly FetchParticipationDownloadCsvUseCase $fetchParticipationDownloadCsvUseCase
    )
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(FetchParticipationDownloadCsvRequest $request)
    {
        $this->fetchParticipationDownloadCsvUseCase->execute($request->getCsvFile());
    }
}
