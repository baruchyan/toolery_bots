<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;

use App\Models\User;
use Telegram\Infrastructure\Models\Bot;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message;

abstract class AbstractCommandHandler
{
    public function __construct(protected readonly Bot $bot, protected readonly Client $client)
    {
    }

    protected string $name;

    protected User|null $user;

    public function getName(): string
    {
        return $this->name;
    }

    public function handle(): \Closure
    {
        return function (Message $message) {
            return $this->commandHandler()(message: $message);
        };
    }

    abstract protected function commandHandler(): \Closure;

    public static function makeCommands(Client $bot, array $commands, TelegramBotEnum $telegramBotEnum): void
    {
        foreach ($commands as $commandHandlerClass) {
            /** @var AbstractCommandHandler $commandHandler */
            $commandHandler = new $commandHandlerClass($bot);
            $commandHandler->setBotEnum(telegramBotEnum: $telegramBotEnum);

            $bot->command($commandHandler->getName(), $commandHandler->handle());
        }
    }
}
