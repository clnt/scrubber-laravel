<?php

namespace ClntDev\LaravelScrubber;

use ClntDev\LaravelScrubber\Adapters\Database;
use ClntDev\LaravelScrubber\Adapters\Logging;
use ClntDev\LaravelScrubber\Console\Commands\ScrubberFieldString;
use ClntDev\LaravelScrubber\Console\Commands\ScrubberRun;
use ClntDev\Scrubber\Contracts\DatabaseUpdate;
use ClntDev\Scrubber\Contracts\Logger;
use Illuminate\Support\ServiceProvider;

class ScrubberServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DatabaseUpdate::class, Database::class);
        $this->app->bind(Logger::class, Logging::class);

        $this->app->bind('scrubber-laravel', static fn (): Scrubber => Scrubber::make());

        $this->mergeConfigFrom(__DIR__ . '/../config/scrubber.php', 'scrubber');
    }

    public function boot(): void
    {
        $this->publishes(
            [__DIR__ . '/../config/scrubber.php'  => config_path('scrubber.php')],
            'scrubber'
        );

        if ($this->app->runningInConsole()) {
            $this->commands([
                ScrubberRun::class,
                ScrubberFieldString::class,
            ]);
        }

        // @codeCoverageIgnoreStart
        if ($this->app->environment('testing') === false) {
            return;
        }

        $this->loadMigrationsFrom(__DIR__ . '/../tests/database/migrations');
        // @codeCoverageIgnoreEnd
    }
}
