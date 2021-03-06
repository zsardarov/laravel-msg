<?php

namespace Zsardarov\Msg;

use Illuminate\Support\ServiceProvider;

class MsgServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/msg.php' => config_path('msg.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/../config/msg.php', 'msg');
    }

    public function register()
    {
        $this->app->bind(MsgService::class);
    }
}
