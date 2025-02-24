<?php

declare(strict_types=1);

namespace App\Actions\Spy;

use App\Models\Spy;

class DeleteSpyAction
{
    public function handle(Spy $spy): void
    {
        $spy->delete();
    }
}
