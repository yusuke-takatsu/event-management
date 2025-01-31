<?php

namespace App\Http\Resources\Common;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AccessDeniedExceptionResource extends JsonResource
{
    public static int $status = 403;

    public static $wrap = null;

    /**
     * @param AccessDeniedHttpException $e
     */
    public function __construct(AccessDeniedHttpException $e)
    {
        parent::__construct($e);
        $this->resource = [
            'message' => '許可されていない操作です。',
            'errors' => [],
        ];
    }
}
