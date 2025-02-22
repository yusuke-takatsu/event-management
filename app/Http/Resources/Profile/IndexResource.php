<?php

namespace App\Http\Resources\Profile;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class IndexResource extends JsonResource
{
    public static $wrap = null;

    /**
     * @param Profile $profile
     */
    public function __construct(private readonly Profile $profile)
    {
        parent::__construct(null);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nick_name' => $this->profile->nick_name,
            'date_of_birth' => $this->profile->date_of_birth,
            'fishing_started_date' => $this->profile->fishing_started_date,
            'image' => $this->convertImage(),
        ];
    }

    /**
     * @return string|null
     */
    private function convertImage(): ?string
    {
        return Storage::disk('s3_private')
            ->url(sprintf('%s/%s', config('filesystems.disks.s3_private.bucket'), $this->profile->image->value()));
    }
}
