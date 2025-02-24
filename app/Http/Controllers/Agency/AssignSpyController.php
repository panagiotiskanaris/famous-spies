<?php

declare(strict_types=1);

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Http\Resources\Agency\AgencyResource;
use App\Models\Agency;
use App\Models\Spy;
use App\Services\AgencyService;

class AssignSpyController extends Controller
{
    public function __invoke(Agency $agency, Spy $spy, AgencyService $service): AgencyResource
    {
        $agency = $service->assignSpyToAgency($spy, $agency);

        return AgencyResource::make($agency);
    }
}
