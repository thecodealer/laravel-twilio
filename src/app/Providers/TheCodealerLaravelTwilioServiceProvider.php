<?php

namespace TheCodealer\LaravelTwilio\Providers;

use Illuminate\Support\ServiceProvider;

use TheCodealer\LaravelTwilio\Traits\ConfigTrait as Config;
use TheCodealer\LaravelTwilio\Commands\ProcessCallRequests;

class TheCodealerLaravelTwilioServiceProvider extends ServiceProvider {
    public function boot() {
        $this->loadRoutesFrom(Config::getBaseDir() . '/routes/routes.php');
        $this->loadMigrationsFrom(Config::getBaseDir() . '/database/migrations');
        if ($this->app->runningInConsole()) {
            $this->commands([
                ProcessCallRequests::class,
            ]);
        }

    }

    public function register() {
        $this->mergeConfigFrom(Config::getBaseDir() . '/config/twilio.php', 'twilio');
        $this->mergeConfigFrom(Config::getBaseDir() . '/config/config.php', 'thecodealer-laravel-twilio-config');
        define('TheCodealerLaravelTwilioTablePrefix', Config::getConfig('table_prefix'));
    }
}