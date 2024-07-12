<?php

namespace Modules\DeliveryService\Http\Controllers\APIControllers\V1\DeliveryBatch;

use App\Enum\BatchStatusEnum;
use App\Http\Helper\Helper;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\DeliverySlotInterface;
use App\Interfaces\UserInterface;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
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
use Modules\DeliveryService\Interfaces\EmptyBagCollectionInterface;
use Modules\DeliveryService\Rules\BatchStatusRule;
use Modules\DeliveryService\Rules\DeliveryBatchStatusRule;
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
    private $emptyBagCollectionRepository;
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
        EmptyBagCollectionInterface $emptyBagCollectionRepository,
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
        $this->emptyBagCollectionRepository = $emptyBagCollectionRepository;
        $this->helper = $helper;
    }

    public function updateDeliveryBatchpProgress(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => ['required', new BatchStatusRule()],
                'map_coordinates' => ['required'],
                'delivery_batch_id' => ['required', 'exists:delivery_batches,id'],
                'vehicle_id' => ['required', 'exists:vehicles,id'],
            ]);
            DB::beginTransaction();

            // Check if validation fails
            if ($validator->fails()) {
                return $this->error($validator->errors(), "Validation Failed", 422);
            }

            $status = $request->get('status');
            $map_coordinates = $request->get('map_coordinates');
            $delivery_batch_id = $request->get('delivery_batch_id');
            $vehicle_id = $request->get('vehicle_id');
            $data = [];

            if ($status == BatchStatusEnum::STARTED->value) {
                $data = [
                    "batch_start_time" => date("Y-m-d H:i:s"),
                    "batch_start_map_coordinates" => $map_coordinates,
                    "status" => $status,
                    "vehicle_id" => $vehicle_id,
                ];
            } elseif ($status == BatchStatusEnum::ENDED->value) {
                $data = [
                    "batch_end_time" => date("Y-m-d H:i:s"),
                    "batch_end_map_coordinates" => $map_coordinates,
                    "status" => $status,
                    "vehicle_id" => $vehicle_id,
                ];

                // Change status of all the collected bags with completed_batch to "Arrived empty at warehouse"

                // $completed_batch_deliveries = $this->deliveryRepository->getAllBatchDeliveries($delivery_batch_id);
                // $delivery_ids = collect($completed_batch_deliveries)->pluck('id')->toArray();
                // $this->emptyBagCollectionRepository->updateBagsTimelineOnDeliveryBatchCompletion($delivery_ids, $vehicle_id);
            }

            $result =  $this->deliveryBatchRepository->updateDeliveryBatch($delivery_batch_id, $data);

            if (!$result) {
                return $this->error($result, "Error: Pickup Batch Not Updated");
            }

            DB::commit();
            return $this->success($result, "Delivery Batch updated successfully");
        } catch (Exception $exception) {
            DB::rollback();
            return $this->error($exception, "Error: " . $exception->getMessage() . ". Contact Support");
        }
    }
}
