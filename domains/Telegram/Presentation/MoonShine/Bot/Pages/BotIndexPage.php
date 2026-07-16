<?php

declare(strict_types=1);

namespace Telegram\Presentation\MoonShine\Bot\Pages;

use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\ID;
use Telegram\Domain\Enums\BotEnum;
use Telegram\Presentation\MoonShine\Bot\BotResource;

/**
 * @extends IndexPage<BotResource>
 */
final class BotIndexPage extends IndexPage
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
                ->attach(BotEnum::class)
        ];
    }

    protected function filters(): iterable
    {
        return [
//
        ];
    }

    /**
     * @param TableBuilder $component
     *
     * @return TableBuilder
     */
    protected function modifyListComponent(ComponentContract $component): TableBuilder
    {
        return $component->columnSelection();
    }

}
