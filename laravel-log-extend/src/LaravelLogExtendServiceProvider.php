<?php

namespace Logextend\LaravelLogExtend;

use Illuminate\Support\ServiceProvider;

class LaravelLogExtendServiceProvider extends ServiceProvider
{
    /**
     *
     * @return void
     * 配置文件
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel_log_extend.php' => config_path('laravel_log_extend.php'),
            ], 'laravel-log-extend-config');
        }
    }

    /**
     * Make config publishment optional by merge the config from the package.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel_log_extend.php',
            'laravel_log_extend'
        );
    }
}
