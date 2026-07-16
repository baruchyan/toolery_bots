<?php

declare(strict_types=1);


return [
    'webhook_url' => env('TELEGRAM_WEBHOOK_URL', config('app.url'))
];
