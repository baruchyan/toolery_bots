<?php

declare(strict_types=1);

namespace Telegram\Domain\Enums;

use App\Contracts\Stringable;

enum BotEnum: string implements Stringable
{
    case sample1 = 'sample1';


    public function toString(): string
    {
        $result = __('telegram.bot.' . $this->value);

        return (is_string($result)) ? $result : 'telegram.bot.' . $this->value;
    }
}
