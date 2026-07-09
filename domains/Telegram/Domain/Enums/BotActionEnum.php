<?php

declare(strict_types=1);

namespace Telegram\Domain\Enums;

enum BotActionEnum: string
{
    case button = 'button';

    case callback = 'callback';

    case command = 'command';

    case customAction = 'customAction';
}
