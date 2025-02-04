<?php

namespace App\Http\UseCase\Profile;

use App\Data\Input\Profile\StoreInputData;
use App\Models\Profile as ModelsProfile;
use App\Services\Profile\DomainService\ExistProfile;
use App\Services\Profile\Entity\Profile;
use App\Services\Profile\ValueObject\DateOfBirth;
use App\Services\Profile\ValueObject\FishingStartedDate;
use App\Services\Profile\ValueObject\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class StoreUseCase
{
    /**
     * @param StoreInputData $input
     * @return void
     */
    public function execute(StoreInputData $input): void
    {
        $user = Auth::user();

        if (ExistProfile::execute($user->id)) {
            Log::info('exists profile', [
                'method' => __METHOD__,
            ]);

            throw ValidationException::withMessages([
                'プロフィールがすでに登録済みです。',
            ]);
        }

        $uploadFilePath = $this->uploadedFile($input);

        $profile = new Profile(
            id: null,
            nickName: $input->nickName,
            dateOfBirth: new DateOfBirth($input->dateOfBirth),
            fishingStartedDate: new FishingStartedDate($input->fishingStartedDate),
            image: is_null($uploadFilePath) ? null : new Image($uploadFilePath),
        );

        ModelsProfile::query()->createFromEntity($profile);
    }

    /**
     * @param StoreInputData $input
     * @return string|null
     */
    private function uploadedFile(StoreInputData $input): ?string
    {
        if (is_null($input->image)) {
            return null;
        }

        $hashFileName = Image::makeHashName($input->image);

        return Storage::disk('s3')->putFile('images', $input->image, $hashFileName);
    }
}
