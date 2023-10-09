<?php

namespace Modules\DeliveryService\Http\Controllers\APIControllers\V1\EmptyBagCollection;

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

            $delivery_bag = $this->deliveryBagRepository->getLastDeliveryBagInfo($bag_id);

            // ----------------GETTTING BAG FROM BAG ID -------------
            // $bag = $this->bagsRepository->getBag($bag_id);
            // $delivery_id = $bag->bagTimeline->last()->delivery_id; // this id refers to the delivery when this bag was delivered
            $delivery_id = $delivery_bag->delivery_id;
            $data = [
                'bag_id' => $bag_id,
                'empty_bag_collection_delivery_id' => $bag_collection_delivery_id,
                'delivery_id' => $delivery_id,
                'customer_id' => $customer_id,

            ];
            $created =  $this->emptyBagCollectionRepository->createBagCollection($data);

            if (!$created) {
                return $this->error($created, "Error occured  while creating  bag collection Please contact support", 500);
            }
            return $this->success($created, "Bag Collected successfully");
        } catch (Exception $exception) {
            dd($exception);
            return $this->error($exception, "Exception while creating  bag collection Please contact support", 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('deliveryservice::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('deliveryservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('deliveryservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
