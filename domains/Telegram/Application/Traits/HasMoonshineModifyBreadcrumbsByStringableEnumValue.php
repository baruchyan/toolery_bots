<?php

declare(strict_types=1);

namespace Telegram\Application\Traits;

use App\Contracts\Stringable;

trait HasMoonshineModifyBreadcrumbsByStringableEnumValue
{
    private function modifyBreadcrumbs(): void
    {
        $breadcrumbs = $this->getBreadcrumbs();

        $lastKey = array_key_last($breadcrumbs);

        if (!is_string($lastKey)) {
            return;
        }

        $lastValue = $breadcrumbs[$lastKey];

        /** @var Stringable $lastValue */
        $breadcrumbs[$lastKey] = $lastValue->toString();

        $this->breadcrumbs(breadcrumbs: $breadcrumbs);
    }
}
