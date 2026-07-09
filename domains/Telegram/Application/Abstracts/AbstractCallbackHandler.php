<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;

use App\Actions\Telegram\CreateTelegramSavedRequestAction;
use App\Enums\TelegramActionEnum;
use App\Enums\TelegramBotEnum;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\CallbackQuery;

abstract class AbstractCallbackHandler
{

    protected int $chatId;

    protected TelegramBotEnum $telegramBotEnum;
    protected int $messageId;

    protected array $data;

    protected ?User $user;

    public function __construct(protected readonly Client $bot, protected readonly CallbackQuery $callbackQuery)
    {
        $this->chatId = $callbackQuery->getMessage()->getChat()->getId();
        $this->user = UserService::getOrCreateUserByChatId(chatId: $this->chatId);

        $this->data = self::getData($this->callbackQuery);
        $this->messageId = $this->callbackQuery->getMessage()->getMessageId();
    }

    public abstract function handle(): void;

    public function setTelegramBotEnum(TelegramBotEnum $telegramBotEnum): void
    {
        $this->telegramBotEnum = $telegramBotEnum;
    }

    public function saveRequest(): void
    {
        new CreateTelegramSavedRequestAction()(
            user: $this->user,
            bot: $this->telegramBotEnum,
            action: TelegramActionEnum::callback,
            requestId: $this->callbackQuery->getMessage()->getMessageId(),
        );
    }

    protected function successAnswer(string $message = ''): void
    {
        $this->bot->answerCallbackQuery(
            $this->callbackQuery->getId(),
            $message,
            true
        );
    }

    public static function getData(CallbackQuery $callbackQuery): array
    {
        return json_decode($callbackQuery->getData(), true);
    }
}
