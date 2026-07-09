<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;

abstract class AbstractCallback
{

    protected string $text;

    protected array $callbackData;

    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'callback_data' => json_encode($this->callbackData)
        ];
    }

}
