<?php

namespace App\Providers;

use App\Events\SpyTransferred;
use App\Listeners\LogSpyTransfer;
use App\Models\Spy;
use App\Observers\SpyObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Spy::observe(SpyObserver::class);

        Event::listen(
            SpyTransferred::class,
            LogSpyTransfer::class,
        );
    }
}
