<?php

namespace App\Logging;

use JsonException;
use Monolog\Formatter\LineFormatter;
use Monolog\LogRecord;

class JsonFormatter extends LineFormatter
{
    /**
     * ログ出力フォーマットをカスタマイズ
     *
     * @param  LogRecord  $record
     * @return string
     *
     * @throws JsonException
     */
    public function format(LogRecord $record): string
    {
        return json_encode(
            [
                'message' => $record->offsetGet('message'),
                'context' => $record->offsetGet('context'),
                'level' => $record->offsetGet('level_name'),
                'channel' => $record->offsetGet('channel'),
                'datetime' => $record->offsetGet('datetime')->format('Y-m-d H:i:s'),
            ],
            JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE
        );
    }
}
