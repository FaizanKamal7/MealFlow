<?php

namespace Modules\DeliveryService\Http\Controllers\APIControllers\V1\DeliveryBatch;

use App\Http\Helper\Helper;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\DeliverySlotInterface;
use App\Interfaces\UserInterface;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\BusinessService\Interfaces\BranchInterface;
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;
use Modules\BusinessService\Interfaces\CustomerInterface;
use Modules\BusinessService\Interfaces\CustomerSecondaryNumberInterface;
use Modules\DeliveryService\Interfaces\DeliveryBatchInterface;
use Modules\DeliveryService\Interfaces\DeliveryInterface;
use Modules\DeliveryService\Interfaces\DeliveryTypeInterface;
use Modules\FleetService\Interfaces\DriverAreaInterface;
use Modules\FleetService\Interfaces\DriverInterface;

use function PHPUnit\Framework\isEmpty;

class DeliveryBatchController extends Controller
{
    private $customerRepository;
    private $cityRepository;
    private $areaRepository;
    private $customerAddressRepository;
    private $deliverySlotRepository;
    private $customerSecondaryNumberRepository;
    private $userRepository;
    private $branchRepository;
    private $businessRepository;
    private $businessCustomerRepository;
    private $deliveryTypeRepository;
    private $deliveryRepository;
    private $helper;
    private $driverAreaRepository;
    private $driverRepository;
    private $deliveryBatchRepository;
    use HttpResponses;

    public function __construct(
        CustomerInterface $customerRepository,
        CityInterface $cityRepository,
        AreaInterface $areaRepository,
        CustomerAddressInterface $customerAddressRepository,
        DeliverySlotInterface $deliverySlotRepository,
        CustomerSecondaryNumberInterface $customerSecondaryNumberRepository,
        UserInterface $userRepository,
        BranchInterface $branchRepository,
        BusinessInterface $businessRepository,
        BusinessCustomerInterface $businessCustomerRepository,
        DeliveryTypeInterface $deliveryTypeRepository,
        DeliveryInterface $deliveryRepository,
        DriverAreaInterface $driverAreaRepository,
        DriverInterface $driverRepository,
        DeliveryBatchInterface $deliveryBatchRepository,

        Helper $helper,
    ) {
        $this->customerRepository = $customerRepository;
        $this->cityRepository = $cityRepository;
        $this->areaRepository = $areaRepository;
        $this->customerAddressRepository = $customerAddressRepository;
        $this->deliverySlotRepository = $deliverySlotRepository;
        $this->userRepository = $userRepository;
        $this->customerSecondaryNumberRepository = $customerSecondaryNumberRepository;
        $this->branchRepository = $branchRepository;
        $this->businessRepository = $businessRepository;
        $this->businessCustomerRepository = $businessCustomerRepository;
        $this->deliveryTypeRepository = $deliveryTypeRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->driverAreaRepository = $driverAreaRepository;
        $this->driverRepository = $driverRepository;
        $this->deliveryBatchRepository = $deliveryBatchRepository;

        $this->helper = $helper;
    }

    public function startDeliveryBatch(Request $request)
    {

        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'batch_id' => ['required'],
                'start_time' => ['required', 'date'],
                'vehicle_id' => ['required'],
                'map_coordinates' => ['required'],
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return $this->error($validator->errors(), "validation failed", 422);
            }

            $batch_id = $request->post('batch_id');
            $start_time = $request->post('start_time');
            $vehicle_id = $request->post('vehicle_id');
            $start_coordinates = $request->post('map_coordinates');

            $data = ['batch_start_time' => $start_time, 'vehicle_id' => $vehicle_id,'status'=>'Pending', 'batch_arrival_map_coordinates' => $start_coordinates];
            $update = $this->deliveryBatchRepository->updateDeliveryBatch($batch_id, $data);

            if (!$update) {
                return $this->error($update, "error occured contact support", 500);
            }

            return $this->success($update, "Batch Started successfully");

        } catch (Exception $exception) {
            return $this->error($exception, "error occured contact support", 500);

        }
    }

    public function endDeliveryBatch(Request $request)
    {

        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'batch_id' => ['required'],
                'end_time' => ['required', 'date'],
                'map_coordinates' => ['required'],
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return $this->error($validator->errors(), "validation failed", 422);
            }

            $batch_id = $request->get('batch_id');
            $end_time = $request->get('end_time');
            $vehicle_id = $request->get('vehicle_id');
            $end_coordinates = $request->get('map_coordinates');

            $data = ['batch_end_time' => $end_time, 'vehicle_id' => $vehicle_id,'status'=>'Completed', 'batch_end_map_coordinates' => $end_coordinates];
            $update = $this->deliveryBatchRepository->updateDeliveryBatch($batch_id, $data);

            if (!$update) {
                return $this->error($update, "error occured contact support", 500);
            }

            return $this->success($update, "Batch Completed successfully");

        } catch (Exception $exception) {
            return $this->error($exception, "error occured contact support", 500);

        }
    }

}