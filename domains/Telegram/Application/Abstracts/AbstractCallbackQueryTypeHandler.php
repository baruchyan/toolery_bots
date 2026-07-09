<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;

use TelegramBot\Api\Client;
use TelegramBot\Api\Types\CallbackQuery;

abstract class AbstractCallbackQueryTypeHandler
{

    protected AbstractMenuService $menuService;

    public function __construct(protected readonly Client $bot, protected readonly array $config)
    {
    }

    public function handle(): void
    {
        $this->bot->callbackQuery(fn(CallbackQuery $callbackQuery) => $this->processing(callbackQuery: $callbackQuery));
    }

    protected abstract function processing(CallbackQuery $callbackQuery): void;
}
