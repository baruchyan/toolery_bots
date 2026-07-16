<?php

use Spatie\Permission\PermissionServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\HorizonServiceProvider::class,
    App\Providers\MoonShineServiceProvider::class,
    App\Providers\TelescopeServiceProvider::class,
    Telegram\Providers\TelegramServiceProvider::class,
    \Sample\Providers\SampleServiceProvider::class,
    PermissionServiceProvider::class,
];
