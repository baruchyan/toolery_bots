<?php

declare(strict_types=1);

namespace Sample\Providers;

use Illuminate\Support\ServiceProvider;

class SampleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php',
            'sample'
        );



    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
