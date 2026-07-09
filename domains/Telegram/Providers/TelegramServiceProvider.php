<?php

declare(strict_types=1);

namespace Telegram\Providers;

use Illuminate\Support\ServiceProvider;

class TelegramServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php',
            'telegram'
        );

//        $this->app->bind(AbstractRegistratorClient::class, function ($app) {
//            return match(RegistratorServiceName::from(value: config('searcher.registrator.service_name'))) {
//                RegistratorServiceName::RegRu => new RegRuClient(),
//                default => null
//            };
//        });



    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
