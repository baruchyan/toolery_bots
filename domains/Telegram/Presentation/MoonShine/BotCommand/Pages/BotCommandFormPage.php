<?php

declare(strict_types=1);

namespace Telegram\Presentation\MoonShine\BotCommand\Pages;

use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use Telegram\Presentation\MoonShine\BotCommand\BotCommandResource;


/**
 * @extends FormPage<BotCommandResource>
 */
class BotCommandFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),

                Checkbox::make(label: 'Активность', column: 'is_active')
                    ->default(default: true),

                BelongsTo::make(label: 'Бот', relationName: 'bot'),

                Text::make(label: 'Команда', column: 'command'),

                Text::make(label: 'Стандартный ответ', column: 'answer')
                    ->nullable(),

                Text::make(label: 'Обработчик', column: 'handler')
                    ->nullable(),
            ]),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [];
    }

}
