<?php

namespace TheCodealer\LaravelTwilio\Traits;

trait ConfigTrait {
    public static function getTablePrefix() {
        return config('thecodealer-laravel-twilio-config.table_prefix');
    }

    public static function getBaseDir() {
        return dirname(dirname(dirname(__FILE__)));
    }

    public static function getConfig($key) {
        return config('thecodealer-laravel-twilio-config.' . $key);
    }
}
