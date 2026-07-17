<?php

declare(strict_types=1);

namespace Telegram\Presentation\MoonShine\Bot\Pages;

use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\Text;
use Telegram\Domain\Enums\BotEnum;
use Telegram\Presentation\MoonShine\Bot\BotResource;

/**
 * @extends FormPage<BotResource>
 */
final class BotFormPage extends FormPage
{

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Checkbox::make(label: 'Активность', column: 'is_active')
                ->default(default: true),

            Text::make('Название', 'title'),

            Enum::make('Бот', 'bot')
                ->placeholder('Выберите из списка')
                ->attach(BotEnum::class),

            Text::make('Token', 'token')
                ->nullable(),

        ];
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [

        ];
    }


}
