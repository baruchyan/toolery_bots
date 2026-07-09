<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;

use App\Actions\Telegram\CreateTelegramSavedRequestAction;
use App\Enums\TelegramActionEnum;
use App\Enums\TelegramBotEnum;
use App\Models\User;
use Illuminate\Support\Facades\Lang;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message;

abstract class AbstractButtonHandler
{

    protected int $chatId;

    protected AbstractMenuService $menuService;
    protected TelegramBotEnum $telegramBotEnum;

    protected bool $removeSavedRequest = true;

    public function __construct(protected readonly User $user, protected readonly Client $bot, protected readonly Message $message)
    {
        $this->chatId = $this->message->getChat()->getId();
    }

    public function setTelegramBotEnum(TelegramBotEnum $telegramBotEnum): void
    {
        $this->telegramBotEnum = $telegramBotEnum;
    }

    public function setMenuService(AbstractMenuService $menuService): void
    {
        $this->menuService = $menuService;
    }

    public function getRemoveSavedRequest(): bool
    {
        return $this->removeSavedRequest;
    }
    abstract public function handle(): void;

    abstract public function handleRequest(): void;

    public function saveRequest(): void
    {
        new CreateTelegramSavedRequestAction()(
            user: $this->user,
            bot: $this->telegramBotEnum,
            action: TelegramActionEnum::button,
            requestId: $this->message->getMessageId(),
            name: $this->message->getText()
        );
    }

    public static function searchButton(string $text, string $langPath): string|null
    {
        $buttons = Lang::get($langPath . '.buttons');

        if (empty($buttons)) {
            return null;
        }

        $buttonIndex = array_search(needle: $text, haystack: $buttons);

        if ($buttonIndex === false) {
            return null;
        }

        return $buttonIndex;
    }

}
