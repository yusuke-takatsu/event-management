<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\UseCase\Auth\LoginUseCase;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param LoginUseCase $useCase
     * @return LoginResource
     */
    public function login(LoginRequest $request, LoginUseCase $useCase): LoginResource
    {
        $useCase->execute($request->makeData());

        return new LoginResource(null);
    }
}
