<?php

namespace Modules\FleetService\Http\Controllers\APIControllers;

use App\Traits\HttpResponses;
use Illuminate\Routing\Controller;
use Modules\FleetService\Interfaces\DriverInterface;
use Modules\FleetService\Interfaces\VehicleInterface;
use Modules\FleetService\Interfaces\VehicleTypeInterface;

class APIController extends Controller
{
    use HttpResponses;
    private VehicleInterface $vehicleRepository;
    private DriverInterface $driverRepository;
    private VehicleTypeInterface $vehicleTypeRepository;
    // private VehicleLogInterface $vehicleLogRepository;

    public function __construct(VehicleInterface $vehicleRepository, DriverInterface $driverRepository, VehicleTypeInterface $vehicleTypeRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->driverRepository = $driverRepository;
        $this->vehicleTypeRepository = $vehicleTypeRepository;
        // $this->vehicleLogRepository = $vehicleLogRepository;
    }

    public function getVehicles()
    {
        $vehicles = $this->vehicleRepository->getVehicles();
        
        return $this->success($vehicles,'vehicles record');
    }
}