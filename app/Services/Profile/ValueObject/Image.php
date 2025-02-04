<?php

namespace App\Services\Profile\ValueObject;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class Image
{
    /**
     * @param string $value
     */
    public function __construct(private readonly string $value) {}

    /**
     * @param UploadedFile $file
     * @return self
     */
    public static function makeHashName(UploadedFile $file): self
    {
        $hashName = sprintf('%s.%s', (string) Str::uuid(), $file->getExtension());

        return new self($hashName);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
