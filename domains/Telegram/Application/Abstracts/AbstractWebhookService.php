<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;


use Sample\Application\Services\SampleBot\WebhookService;
use Telegram\Domain\Enums\BotEnum;
use Telegram\Domain\Exceptions\DeleteWebhookException;
use Telegram\Domain\Exceptions\EmptyTokenException;
use Telegram\Domain\Exceptions\SetWebhookException;
use Telegram\Infrastructure\Models\Bot;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\WebhookInfo;

abstract class AbstractWebhookService
{
    protected Client $client;

    private function __construct(protected readonly Bot $bot)
    {
        if (is_null($this->bot->token)) {
            throw new EmptyTokenException();
        }

        $this->client = new Client(token: $this->bot->token);
    }

    abstract public function handle(): void;

    public function setWebhook(): void
    {
        $url = rtrim(string: config('telegram.webhook_url'), characters: '/') . route(
                name: 'api.telegram.webhook',
                parameters: ['bot' => $this->bot],
                absolute: false);

        if (!$this->client->setWebhook(url: $url)) { // @phpstan-ignore-line
            throw new SetWebhookException();
        }
    }

    public function getWebhookInfo(): array
    {
        /** @var WebhookInfo $info */
        $info = $this->client->getWebhookInfo(); // @phpstan-ignore-line

        $result = $info->toJson();

        return is_array($result) ? $result : json_decode($result, true);
    }

    public function deleteWebhook(): void
    {
        if (!$this->client->deleteWebhook()) { // @phpstan-ignore-line
            throw new DeleteWebhookException();
        }
    }

    public static function make(Bot $bot): self
    {
        return match ($bot->bot) {
            BotEnum::sample1 => new WebhookService(bot: $bot)
        };
    }
}
