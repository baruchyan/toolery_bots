<?php

declare(strict_types=1);

namespace Telegram\Presentation\MoonShine\BotCommand\Pages;

use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Fields\ID;
use Telegram\Presentation\MoonShine\BotCommand\BotCommandResource;


/**
 * @extends IndexPage<BotCommandResource>
 */
class BotCommandIndexPage extends IndexPage
{
    protected bool $isLazy = true;

    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
        ];
    }


}
