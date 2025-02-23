<?php

namespace App\Actions\Spies;

use App\Models\Spy;

class DeleteSpyAction
{
    public function handle(Spy $spy): void
    {
        $spy->delete();
    }
}
