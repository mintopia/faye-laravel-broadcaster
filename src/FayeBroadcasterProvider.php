<?php

namespace ArnisLielturks\FayeBroadcaster;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Broadcasting\BroadcastManager;
use App\Services\FayeBroadcaster\FayeBroadcaster;
use Log;

class FayeBroadcasterProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(BroadcastManager $broadcastManager)
    {
        $broadcastManager->extend('faye', function ($app, array $config) {
            return new FayeBroadcaster(config('faye'));
        });
    }
}
