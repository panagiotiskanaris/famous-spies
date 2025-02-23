<?php

namespace App\Listeners;

use App\Events\SpyTransferred;
use Illuminate\Support\Facades\Log;

class LogSpyTransfer
{
    public function handle(SpyTransferred $event): void
    {
        Log::info('Spy transferred', [
            'spy_id' => $event->spy->id,
            'new_agency_id' => $event->spy->agency_id,
        ]);
    }
}
