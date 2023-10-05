<?php

namespace App\DataTransferObjects;

use App\Enums\PostStatus;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

#[MapName(SnakeCaseMapper::class)]
class Post extends Data
{
    public function __construct(
      public string $title,
      public string $content,
      #[WithCast(PostStatusCast::class)]
      #[WithTransformer(PostStatusTransformer::class)]
      public PostStatus $status,
      #[Date]
      #[WithCast(DateTimeInterfaceCast::class, format:'Y-m-d')]
      public ?CarbonImmutable $publishedAt
    ) {}
}
