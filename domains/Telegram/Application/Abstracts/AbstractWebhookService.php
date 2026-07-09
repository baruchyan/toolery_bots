<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;

use App\Enums\TelegramBotEnum;
use App\Exceptions\Telegram\TelegramConfigException;
use Telegram\Domain\Enums\BotEnum;
use TelegramBot\Api\Client;

abstract class AbstractWebhookService
{
    protected BotEnum $botEnum;

    protected Client $bot;

    protected array $config;

    private function __construct(protected readonly string $token)
    {
        $this->bot = new Client(token: $token);
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    public function setBotEnum(TelegramBotEnum $botEnum): void
    {
        $this->botEnum = $botEnum;
    }

    abstract public function handle(): void;

    public function setWebhook(): void
    {
        $this->bot->setWebhook($this->config['webhook'] . route(
            name: 'api.telegram.webhook',
            parameters: [$this->botEnum],
            absolute: false
        ));
    }

    public static function make(BotEnum $bot): static
    {
        $configPath = match ($bot) {
            BotEnum::sample1 => 'domains.wheel.telegram',
            default => null,
        };

        if (is_null($configPath)) {
            throw new TelegramConfigException();
        }

        $config = config($configPath);

        /** @var static $service */
        $service = new $config['service']($config['token']);
        $service->setConfig(config: $config);
        $service->setBotEnum(botEnum: $bot);

        return $service;
    }
}
