<?php

namespace AndrewMast\Laravel\Utilities\Clean;

use Illuminate\Support\ServiceProvider;

class UtilitiesCleanServiceProvider extends ServiceProvider {
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\UtilitiesCleanAll::class,
                Commands\UtilitiesCleanBraces::class,
                Commands\UtilitiesCleanUses::class,
            ]);
        }
    }
}
