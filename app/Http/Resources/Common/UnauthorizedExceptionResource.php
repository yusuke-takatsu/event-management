<?php

namespace App\Http\Resources\Common;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\UnauthorizedException;

class UnauthorizedExceptionResource extends JsonResource
{
    public static int $status = 401;

    public static $wrap = null;

    /**
     * @param UnauthorizedException|AuthenticationException $e
     */
    public function __construct(UnauthorizedException|AuthenticationException $e)
    {
        parent::__construct($e);
        $this->resource = [
            'message' => 'ログインしてください。',
            'errors' => [],
        ];
    }
}
