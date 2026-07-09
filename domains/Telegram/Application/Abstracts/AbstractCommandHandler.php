<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;

use App\Enums\TelegramBotEnum;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message;

abstract class AbstractCommandHandler
{
    public function __construct(protected readonly Client $bot)
    {
    }

    protected string $name;

    protected User|null $user;

    protected AbstractMenuService $menuService;

    protected TelegramBotEnum $telegramBotEnum;

    public function setTelegramBotEnum(TelegramBotEnum $telegramBotEnum): void
    {
        $this->telegramBotEnum = $telegramBotEnum;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    public function handle(): \Closure
    {
        return function (Message $message) {
            $this->user = UserService::getOrCreateUserByChatId(chatId: $message->getChat()->getId());

            $this->menuService = AbstractMenuService::make(telegramBotEnum: $this->telegramBotEnum);

            return $this->commandHandler()(message: $message);
        };
    }

    abstract protected function commandHandler(): \Closure;

    public static function makeCommands(Client $bot, array $commands, TelegramBotEnum $telegramBotEnum): void
    {
        foreach ($commands as $commandHandlerClass) {
            /** @var AbstractCommandHandler $commandHandler */
            $commandHandler = new $commandHandlerClass($bot);
            $commandHandler->setTelegramBotEnum(telegramBotEnum: $telegramBotEnum);

            $bot->command($commandHandler->getName(), $commandHandler->handle());
        }
    }
}
