<?php

declare(strict_types=1);

namespace Telegram\Infrastructure\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property bool $is_active
 * @property int $bot_id
 * @property Bot $bot
 * @property string $command
 * @property ?string $answer
 * @property ?string $handler
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class BotCommand extends Model
{
    use SoftDeletes;

    protected $table = 'telegram_bot_commands';

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<Bot, $this>
     */
    public function bot(): BelongsTo
    {
        return $this->belongsTo(Bot::class, 'bot_id');
    }
}
