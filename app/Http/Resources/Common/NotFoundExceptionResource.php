<?php

namespace App\Http\Resources\Common;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundExceptionResource extends JsonResource
{
    public static int $status = 404;

    public static $wrap = null;

    /**
     * @param NotFoundHttpException $e
     */
    public function __construct(NotFoundHttpException $e)
    {
        parent::__construct($e);
        $this->resource = [
            'message' => '対象のデータが見つかりませんでした。',
            'errors' => [],
        ];
    }
}
