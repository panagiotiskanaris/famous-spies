<?php

declare(strict_types=1);

namespace App\Actions\Spy;

use App\Exceptions\SpyDeletionException;
use App\Models\Spy;
use Throwable;

class DeleteSpyAction
{
    /**
     * @throws Throwable
     */
    public function handle(Spy $spy): void
    {
        throw_if(
            $spy->missions()->active()->count() > 0,
            new SpyDeletionException('Spy has ongoing missions and cannot be deleted.'),
        );

        $spy->delete();
    }
}
