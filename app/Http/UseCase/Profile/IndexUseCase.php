<?php

namespace App\Http\UseCase\Profile;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class IndexUseCase
{
    /**
     * @return Profile
     */
    public function execute(): Profile
    {
        return Profile::query()->findOrFail(Auth::id());
    }
}
