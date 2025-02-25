<?php

namespace App\Services;

use App\Exceptions\AssignSpyException;
use App\Models\Agency;
use App\Models\Spy;
use Throwable;

class AgencyService
{
    /**
     * @throws Throwable
     */
    public function assignSpyToAgency(Spy $spy, Agency $agency): Agency
    {
        throw_if(
            $spy->agency_id === $agency->id,
            new AssignSpyException('The selected Spy is already assigned to this agency.'),
        );

        $agency->spies()->save($spy);

        return $agency->load('spies');
    }
}
