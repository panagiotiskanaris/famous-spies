<?php

declare(strict_types=1);

namespace App\Http\Controllers\Agency;

use App\Exceptions\AssignSpyException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Agency\AgencyResource;
use App\Models\Agency;
use App\Models\Spy;
use App\Services\AgencyService;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AssignSpyController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(Agency $agency, Spy $spy, AgencyService $service): AgencyResource
    {
        try {
            $agency = $service->assignSpyToAgency($spy, $agency);
        } catch (AssignSpyException $exception) {
            abort(Response::HTTP_BAD_REQUEST, $exception->getMessage());
        }

        return AgencyResource::make($agency);
    }
}
