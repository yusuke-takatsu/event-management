<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Transformers\Transformer;

class PostStatusTransformer implements Transformer
{
    public function transform(DataProperty $property, mixed $value): string
    {
        return $value->value;
    }
}