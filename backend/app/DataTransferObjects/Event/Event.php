<?php

namespace App\DataTransferObjects\Event;

use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Data;

class Event extends Data
{
    /**
     * @param string $title
     * @param string $description
     * @param string $location
     * @param string $event_date
     * @param string $event_time
     */
    public function __construct(
      public string $title,
      public string $description,
      public string $location,
      #[Date]
      public string $event_date,
      #[DateFormat('H:i')]
      public string $event_time
    ) {}
}
