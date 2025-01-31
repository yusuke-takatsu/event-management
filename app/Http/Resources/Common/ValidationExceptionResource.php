<?php

namespace App\Http\Resources\Common;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class ValidationExceptionResource extends JsonResource
{
    public static int $status = 422;

    public static $wrap = null;

    /**
     * @param ValidationException $e
     */
    public function __construct(ValidationException $e)
    {
        parent::__construct($e);
        $this->resource = [
            'message' => $e->getMessage(),
            'errors' => $e->errors(),
        ];
    }
}
