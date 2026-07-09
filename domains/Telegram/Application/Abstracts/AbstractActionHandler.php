<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;

use App\Models\User;
use TelegramBot\Api\Client;

abstract class AbstractActionHandler
{

    public function __construct(protected readonly Client $bot, protected readonly User $user)
    {
    }

    public static function make(Client $bot, User $user): static
    {
        return new static($bot, $user);
    }

}
