<?php

namespace App\Services;

use App\Models\Agency;
use App\Models\Spy;

class AgencyService
{
    public function assignSpyToAgency(Spy $spy, Agency $agency): Agency
    {
        $agency->spies()->save($spy);

        return $agency->load('spies');
    }
}
