<?php

namespace App\Observers;

use App\Events\SpyTransferred;
use App\Models\Agency;
use App\Models\Spy;
use Illuminate\Support\Facades\Log;

class SpyObserver
{
    public function created(Spy $spy): void
    {
        Log::info('A new Spy has been created.', [
            'spy' => $spy,
        ]);
    }

    public function updated(Spy $spy): void
    {
        if ($spy->isDirty('agency_id')) {
            event(new SpyTransferred($spy));
        }
    }
}
