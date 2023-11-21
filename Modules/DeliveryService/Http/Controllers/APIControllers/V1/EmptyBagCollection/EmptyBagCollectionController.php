<?php

namespace Modules\DeliveryService\Http\Controllers\APIControllers\V1\EmptyBagCollection;

use App\Enum\EmptyBagCollectionStatusEnum;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\DeliveryService\Interfaces\EmptyBagCollectionBatchInterface;
use Modules\DeliveryService\Interfaces\EmptyBagCollectionInterface;
use Modules\DeliveryService\Interfaces\BagsInterface;
use Modules\DeliveryService\Interfaces\BagStatusInterface;
use Modules\DeliveryService\Interfaces\DeliveryBagInterface;
use Modules\DeliveryService\Interfaces\DeliveryInterface;
use Modules\DeliveryService\Rules\BatchStatusRule;

class EmptyBagCollectionController extends Controller
{
    private BagsInterface $bagsRepository;
    private BusinessInterface $businessRepository;
    private BagStatusInterface $bagStatusRepository;
    private DeliveryInterface $deliveryRepository;
    private EmptyBagCollectionInterface $emptyBagCollectionRepository;
    private EmptyBagCollectionBatchInterface $emptyBagCollectionBatchRepository;
    private DeliveryBagInterface $deliveryBagRepository;

    use HttpResponses;



    /**
     * @param BagsInterface $bagsRepository
     */
    public function __construct(
        BagsInterface $bagsRepository,
        BusinessInterface $businessRepository,
        BagStatusInterface $bagStatusRepository,
        DeliveryInterface $deliveryRepository,
        EmptyBagCollectionInterface $emptyBagCollectionRepository,
        EmptyBagCollectionBatchInterface $emptyBagCollectionBatchRepository,
        DeliveryBagInterface $deliveryBagRepository,
    ) {
        $this->businessRepository = $businessRepository;
        $this->bagsRepository = $bagsRepository;
        $this->bagStatusRepository = $bagStatusRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->emptyBagCollectionRepository = $emptyBagCollectionRepository;
        $this->emptyBagCollectionBatchRepository = $emptyBagCollectionBatchRepository;
        $this->deliveryBagRepository = $deliveryBagRepository;
    }

    public function createBagCollectionAtDelivery(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make(
                $request->all(),
                [
                    'bag_id' => ['required', 'exists:bags,id'],
                    'empty_bag_collection_delivery_id' => [
                        'required',
                        'exists:deliveries,id',
                        Rule::unique('empty_bag_collections')->where(function ($query) use ($request) {
                            return $query->where('bag_id', $request->bag_id)
                                ->where('empty_bag_collection_delivery_id', $request->empty_bag_collection_delivery_id);
                        }),
                    ],
                ],
                [
                    'empty_bag_collection_delivery_id.unique' => 'Bag already collected. Please scan other bag.',
                ]
            );

            // Check if validation fails
            if ($validator->fails()) {
                return $this->error($validator->errors(), "validation failed", 422);
            }

            $bag_id = $request->post('bag_id');
            $bag_collection_delivery_id = $request->post('empty_bag_collection_delivery_id'); // This refers to the delivery id when this bag was being collected
            $customer_id = $request->post('customer_id');
            $delivery_slot_id = $request->post('delivery_slot_id');
            $customer_address_id = $request->post('customer_address_id');



            $delivery_bag = $this->deliveryBagRepository->getLastDeliveryBagInfo($bag_id);
            if ($delivery_bag == null) {
                return $this->error($bag_id, "Error: Bag is not associated with any delivery", 500);
            }
            // ----------------GETTTING BAG FROM BAG ID -------------
            // $bag = $this->bagsRepository->getBag($bag_id);
            // $delivery_id = $bag->bagTimeline->last()->delivery_id; // this id refers to the delivery when this bag was delivered
            $data = [
                'bag_id' => $bag_id,
                'empty_bag_collection_delivery_id' => $bag_collection_delivery_id,
                'delivery_id' => $delivery_bag->delivery_id,
                'customer_id' => $customer_id,
                'delivery_slot_id' => $delivery_slot_id,
                'customer_address_id' => $customer_address_id,
                'status' => EmptyBagCollectionStatusEnum::COMPLETED->value,
            ];
            $created =  $this->emptyBagCollectionRepository->createBagCollection($data);

            if (!$created) {
                return $this->error($created, "Error occured while creating  bag collection Please contact support", 500);
            }
            return $this->success($created, "Bag Collected successfully");
        } catch (Exception $exception) {
            return $this->error($exception, "Error: " . $exception->getMessage(), 500);
        }
    }

    public function updateBagCollectionBatchpProgress(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => ['required', new BatchStatusRule()],
                'map_coordinates' => ['required'],
                'pickup_batch_id' => ['required', 'exists:pickup_batches,id'],
                'vehicle_id' => ['required', 'exists:vehicles,id'],
            ]);
            DB::beginTransaction();

            // Check if validation fails
            if ($validator->fails()) {
                return $this->error($validator->errors(), "Validation Failed", 422);
            }

            $status = $request->get('status');
            $map_coordinates = $request->get('map_coordinates');
            $pickup_batch_id = $request->get('pickup_batch_id');
            $vehicle_id = $request->get('vehicle_id');


            $data = $status == BatchStatusEnum::STARTED->value ? [
                "batch_start_time" => date("Y-m-d H:i:s"),
                "batch_start_map_coordinates" => $map_coordinates,
                "status" => $status,
                "vehicle_id" => $vehicle_id,
            ] : [
                "batch_end_time" => date("Y-m-d H:i:s"),
                "batch_end_map_coordinates" => $map_coordinates,
                "status" => $status,
                "vehicle_id" => $vehicle_id,
            ];

            $result =  $this->emptyBagCollectionBatchRepository->updateBagCollectionBatch($pickup_batch_id, $data);

            if (!$result) {
                return $this->error($result, "Error: Pickup Batch Not Updated");
            }

            DB::commit();
            return $this->success($result, "Pickup Batch updated successfully");
        } catch (Exception $exception) {
            DB::rollback();
            return $this->error($exception, "Something went wrong please contact support");
        }
    }
}
