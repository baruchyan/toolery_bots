<?php

declare(strict_types=1);

namespace Telegram\Presentation\MoonShine\Bot\Pages;


use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use Telegram\Domain\Enums\BotEnum;
use Telegram\Presentation\MoonShine\Bot\BotResource;

/**
 * @extends DetailPage<BotResource>
 */
final class BotDetailPage extends DetailPage
{

    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),

            Enum::make('Бот', 'bot')
                ->placeholder('Выберите из списка')
                ->attach(BotEnum::class),

            Text::make('Token', 'token')
                ->nullable(),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons()
            ->add(ActionButton::make('Set webhook')->method('setWebhook'))
            ->add(ActionButton::make('Get webhook info')->method('getWebhook'))
            ->add(ActionButton::make('Delete webhook')->method('deleteWebhook'));
    }


}
