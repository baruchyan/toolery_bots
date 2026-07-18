<?php

declare(strict_types=1);

namespace Telegram\Infrastructure\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Telegram\Domain\Enums\BotEnum;

/**
 * @property int $id
 * @property bool $is_active
 * @property string $title
 * @property BotEnum $bot
 * @property ?string $token
 * @property string $webhook_service
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property Collection<int, BotCommand> $commands
 */
class Bot extends Model
{
    use SoftDeletes;

    protected $table = 'telegram_bots';

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'bot' => BotEnum::class,
        ];
    }

    /**
     * @return HasMany<BotCommand, $this>
     */
    public function commands(): HasMany
    {
        return $this->hasMany(BotCommand::class, 'bot_id');
    }
}
