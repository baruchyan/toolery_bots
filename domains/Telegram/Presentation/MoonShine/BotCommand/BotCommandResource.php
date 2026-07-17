<?php

declare(strict_types=1);

namespace Telegram\Presentation\MoonShine\BotCommand;


use MoonShine\Laravel\Resources\ModelResource;
use Telegram\Infrastructure\Models\BotCommand;
use Telegram\Presentation\MoonShine\BotCommand\Pages\BotCommandDetailPage;
use Telegram\Presentation\MoonShine\BotCommand\Pages\BotCommandFormPage;
use Telegram\Presentation\MoonShine\BotCommand\Pages\BotCommandIndexPage;

/**
 * @extends ModelResource<BotCommand, BotCommandIndexPage, BotCommandFormPage, BotCommandDetailPage>
 */
class BotCommandResource extends ModelResource
{
    protected string $model = BotCommand::class;

    protected string $title = 'Команды';

    protected function pages(): array
    {
        return [
            BotCommandIndexPage::class,
            BotCommandFormPage::class,
            BotCommandDetailPage::class,
        ];
    }
}
