<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;

use App\Enums\TelegramBotEnum;
use App\Models\User;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;
use Wheel\Services\Telegram\MenuService;

abstract class AbstractMenuService
{
    protected ?User $user;

    public static function make(TelegramBotEnum $telegramBotEnum): static|null
    {
        return match ($telegramBotEnum) {
            TelegramBotEnum::wheel => new MenuService(),
            default => null
        };
    }

    abstract public function makeMainMenuKeyboard(): ReplyKeyboardMarkup;

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }


}
