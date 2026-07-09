<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;

use App\Enums\TelegramBotEnum;
use App\Models\User;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message;

abstract class AbstractCustomActionHandler
{

    protected int $chatId;

    protected AbstractMenuService $menuService;
    protected TelegramBotEnum $telegramBotEnum;

    protected ?array $data = null;

    protected bool $removeSavedRequest = true;

    public function __construct(protected readonly User $user, protected readonly Client $bot, protected readonly Message $message)
    {
        $this->chatId = $this->message->getChat()->getId();
    }

    public function getRemoveSavedRequest(): bool
    {
        return $this->removeSavedRequest;
    }

    public function setTelegramBotEnum(TelegramBotEnum $telegramBotEnum): void
    {
        $this->telegramBotEnum = $telegramBotEnum;
    }

    public function setMenuService(AbstractMenuService $menuService): void
    {
        $this->menuService = $menuService;
    }

    public function setData(?array $data): void
    {
        $this->data = $data;
    }

    abstract public function handle(): void;

    abstract public function handleRequest(): void;


}
