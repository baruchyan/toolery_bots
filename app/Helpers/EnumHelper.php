<?php

declare(strict_types=1);

namespace App\Helpers;

use MoonShine\Support\DTOs\Select\Option;

class EnumHelper
{
    public static function toKeyLang(string $enumClass, string $langFile): array
    {
        $result = [];

        foreach ($enumClass::cases() as $enum) {
            $result[$enum->value] = __($langFile .'.' . $enum->value);
        }

        return $result;
    }

    public static function toIdTitle(string $enumClass, string $langFile): array
    {
        $result = [];

        foreach ($enumClass::cases() as $enum) {
            $result[] = [
                'id' => $enum->value,
                'title' => __($langFile .'.' . $enum->value)
            ];
        }

        return $result;
    }

    public static function toMoonShineSelect(string $enumClass, string $langFile): array
    {
        $result = [];

        foreach ($enumClass::cases() as $enum) {
            $result[] = new Option(
                label: __($langFile .'.' . $enum->value),
                value: $enum->value
            );
        }

        return $result;
    }
}
