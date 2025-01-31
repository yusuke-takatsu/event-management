<?php

namespace App\Http\UseCase\Auth;

use App\Data\Input\Auth\RegisterInputData;
use App\Models\EmailVerificationToken;
use App\Models\User as ModelsUser;
use App\Services\User\DomainService\ExistEmail;
use App\Services\User\Entity\User;
use App\Services\User\ValueObject\Email;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RegisterUseCase
{
    /**
     * @param RegisterInputData $input
     * @return void
     */
    public function execute(RegisterInputData $input): void
    {
        $user = User::createInitialUser(
            new Email($input->email),
            $input->password,
        );

        if (ExistEmail::execute($user->email)) {
            Log::info('existing is email', [
                'method' => __METHOD__,
            ]);

            throw ValidationException::withMessages([
                '入力されたメールアドレスは登録済みです。',
            ]);
        }

        $userEloquentModel = DB::transaction(function () use ($user) {
            $userEloquentModel = ModelsUser::query()->createFromEntity($user);

            EmailVerificationToken::query()->updateOrCreateToken($userEloquentModel->id);

            return $userEloquentModel;
        });

        event(new Registered($userEloquentModel));
    }
}
