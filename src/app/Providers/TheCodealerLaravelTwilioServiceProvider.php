<?php

namespace TheCodealer\LaravelTwilio\Providers;

use Illuminate\Support\ServiceProvider;

use TheCodealer\LaravelTwilio\Traits\ConfigTrait as Config;

class TheCodealerLaravelTwilioServiceProvider extends ServiceProvider {
    public function boot() {
        $this->loadRoutesFrom(Config::getBaseDir() . '/routes/routes.php');
        $this->loadMigrationsFrom(Config::getBaseDir() . '/database/migrations');
    }

    public function register() {
        $this->mergeConfigFrom(Config::getBaseDir() . '/config/twilio.php', 'twilio');
        $this->mergeConfigFrom(Config::getBaseDir() . '/config/config.php', 'thecodealer-laravel-twilio-config');
        if (!defined('TheCodealerLaravelTwilioTablePrefix')) {
            define('TheCodealerLaravelTwilioTablePrefix', Config::getConfig('table_prefix'));
        }
    }
}