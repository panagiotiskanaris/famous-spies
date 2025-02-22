<?php

namespace App\Observers;

use App\Models\Spy;
use Illuminate\Support\Facades\Log;

class SpyObserver
{
    /**
     * Handle the Spy "created" event.
     */
    public function created(Spy $spy): void
    {
        Log::info('A new Spy has been created.', [
            'spy' => $spy,
        ]);
    }
}
