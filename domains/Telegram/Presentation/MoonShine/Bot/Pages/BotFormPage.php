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
use Telegram\Application\Traits\HasMoonshineModifyBreadcrumbsByStringableEnumValue;
use Telegram\Domain\Enums\BotEnum;
use Telegram\Presentation\MoonShine\Bot\BotResource;

/**
 * @extends FormPage<BotResource>
 */
final class BotFormPage extends FormPage
{

    use HasMoonshineModifyBreadcrumbsByStringableEnumValue;

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Checkbox::make('is_active'),
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

    protected function onLoad(): void
    {
        $this->modifyBreadcrumbs();

        parent::onLoad();
    }

}
