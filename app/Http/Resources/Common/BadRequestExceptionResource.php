<?php

namespace App\Http\Resources\Common;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class BadRequestExceptionResource extends JsonResource
{
    public static int $status = 400;

    public static $wrap = null;

    /**
     * @param BadRequestHttpException $e
     */
    public function __construct(BadRequestHttpException $e)
    {
        parent::__construct($e);
        $this->resource = [
            'message' => '不正なリクエストです。',
            'errors' => [],
        ];
    }
}
