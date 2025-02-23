<?php

namespace App\Events;

use App\Models\Agency;
use App\Models\Spy;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SpyTransferred
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Spy $spy)
    {
        //
    }
}
