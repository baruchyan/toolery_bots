<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;

use App\Models\User;
use Telegram\Infrastructure\Models\Bot;
use Telegram\Infrastructure\Models\BotCommand;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Message;

abstract class AbstractCommandHandler
{
    public function __construct(protected readonly Bot $bot, protected readonly Client|BotApi $client)
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

    public static function makeCommands(Bot $bot, Client $client): void
    {

        $bot->commands->each(function (BotCommand $command) use ($client) {

            if (is_null($command->handler) && !is_null($command->answer)) {
                $client->command(name: $command->command, action: function (Message $message) use ($client, $command) {
                    $client->sendMessage(
                        chatId: $message->getChat()->getId(),
                        text: $command->answer,
                        parseMode: 'html'
                    );
                });

                return;
            }


        });


    }
}
