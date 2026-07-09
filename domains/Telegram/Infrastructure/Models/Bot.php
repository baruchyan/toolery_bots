<?php

declare(strict_types=1);

namespace Telegram\Infrastructure\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Telegram\Domain\Enums\BotEnum;

/**
 * @property int $id
 * @property bool $is_active
 * @property BotEnum $bot
 * @property string $token
 * @property string $webhook_service
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Bot extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'bot' => BotEnum::class,
        ];
    }
}
