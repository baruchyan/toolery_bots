<?php

namespace App\Services\Logger\Formatters;

use Monolog\Formatter\JsonFormatter;

class MonologJsonWithStacktraceFormatter extends JsonFormatter
{
    public function __construct(int $batchMode = self::BATCH_MODE_JSON, bool $appendNewline = true, bool $ignoreEmptyContextAndExtra = false, bool $includeStacktraces = false)
    {
        parent::__construct($batchMode, $appendNewline, $ignoreEmptyContextAndExtra, true);
    }
}
