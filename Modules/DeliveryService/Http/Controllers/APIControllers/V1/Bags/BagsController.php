<?php

namespace Modules\DeliveryService\Http\Controllers\APIControllers\V1\Bags;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\DeliveryService\Interfaces\BagsInterface;
use Modules\DeliveryService\Interfaces\BagStatusInterface;
use Modules\DeliveryService\Interfaces\DeliveryInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BagsController extends Controller
{

    private BagsInterface $bagsRepository;
    private BusinessInterface $businessRepository;
    private BagStatusInterface $bagStatusRepository;
    private DeliveryInterface $deliveryRepository;



    /**
     * @param BagsInterface $bagsRepository
     */
    public function __construct(
        BagsInterface $bagsRepository,
        BusinessInterface $businessRepository,
        BagStatusInterface $bagStatusRepository,
        DeliveryInterface $deliveryRepository
    ) {
        $this->businessRepository = $businessRepository;
        $this->bagsRepository = $bagsRepository;
        $this->bagStatusRepository = $bagStatusRepository;
        $this->deliveryRepository = $deliveryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function viewAllBags()
    {
        $businesses = $this->businessRepository->getBusinesses();
        $bags = $this->bagsRepository->getBags();
        $context = ["businesses" => $businesses, "bags" => $bags];
        return view('deliveryservice::bags.view_bags', $context);
    }
    public function addBag()
    {
        $businesses = $this->businessRepository->getBusinesses();
        $context = ["businesses" => $businesses];
        return view('deliveryservice::bags.add_bag', $context);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeBag(Request $request)
    {
        $path = 'media/bags/qrcodes/' . time() . '.svg';

        $request->validate([
            'business_id' => ['required'],
            'no_of_bags' => ['required', 'numeric']
        ]);

        $bag_count = (int) $request->get("no_of_bags");

        try {
            for ($i = 0; $i < $bag_count; $i++) {
                $bag = $this->bagsRepository->addNewBag(qrCode: "", business_id: $request->get("business_id"), bagNumber: $request->get("bag_number"), bagSize: $request->get("bag_size"), bagType: $request->get("bag_size"), weight: $request->get("weight"), dimensions: $request->get("dimensions"));
                QrCode::size(400)
                    ->generate($bag->id, $path);
                $this->bagsRepository->updateBag(id: $bag->id, business_id: $bag->business_id, qrCode: $path, bagNumber: $bag->bag_number, bagSize: $bag->bag_size, bagType: $bag->bag_type, status_id: $bag->state_id, weight: $bag->weight, dimensions: $bag->dimensions);
            }

            return redirect()->route("add_new_bag")->with("Success", "Bags added successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            echo "error";
            // TODO REMOVE THIS
            dd($exception);
            // return redirect()->to("del_bags")->with("error", "Something went wrong!Contact support");
        }
    }
    public function viewBusinessBag(Request $request)
    {
        $business_id = $request->get("business_id");

        $businesses = $this->businessRepository->getBusinesses();
        $bags = $this->businessRepository->getBusiness($business_id)->bags;

        $context = ["businesses" => $businesses, "bags" => $bags];
        return view('deliveryservice::bags.view_bags', $context);
    }
    /**
     * Show the specified resource.
     * @param int $id
     */
    public function showBag($id)
    {
        return view('deliveryservice::show');
    }

    public function bagTimeline(Request $request, $id)
    {
        $bag = $this->bagsRepository->getBag($id);
        $context = ["bag" => $bag];
        return view('deliveryservice::bags.bag_timeline', $context);
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editBag($id)
    {
        return view('deliveryservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function updateBagStatus(Request $request, $id)
    {

        $status_id = $this->bagStatusRepository->getStatus("at partner location")->id;
        $this->bagsRepository->updateStatus(id: $id, status_id: $status_id);
    }

    public function unassignedBagsPickup()
    {

        $start_date = '2023-09-24';
        $end_date = '2023-09-25';
        $deliveries = $this->deliveryRepository->get($start_date, $end_date);
        return view('deliveryservice::bags.bags_pickup.unasssigned_bag_pickups.blade', ['deliveries' => $deliveries]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyBag($id)
    {
        //
    }
}
