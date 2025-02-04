<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\StoreRequest;
use App\Http\Resources\Profile\StoreResource;
use App\Http\UseCase\Profile\StoreUseCase;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * @param StoreRequest $request
     * @param StoreUseCase $useCase
     * @return StoreResource
     */
    public function store(StoreRequest $request, StoreUseCase $useCase): StoreResource
    {
        $this->authorize('store', Profile::class);

        $useCase->execute($request->makeData());

        return new StoreResource(null);
    }
}
