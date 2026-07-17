<?php

declare(strict_types=1);


use Telegram\Presentation\Controllers\WebhookController;

Route::post('/webhook/{bot}', WebhookController::class)
    ->name('webhook');

Route::get('/webhook/{bot}', WebhookController::class)
    ->name('webhookg');
