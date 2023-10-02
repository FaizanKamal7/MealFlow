<?php

namespace Modules\DeliveryService\Http\Controllers\Bags;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\DeliveryService\Entities\PickupBatch;
use Modules\DeliveryService\Interfaces\BagsInterface;
use Modules\DeliveryService\Interfaces\BagStatusInterface;
use Modules\DeliveryService\Interfaces\DeliveryInterface;
use Modules\DeliveryService\Interfaces\PickupBatchInterface;
use Modules\FleetService\Repositories\DriverRepository;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BagsController extends Controller
{

    private BagsInterface $bagsRepository;
    private BusinessInterface $businessRepository;
    private BagStatusInterface $bagStatusRepository;
    private DeliveryInterface $deliveryRepository;
    private DriverRepository $driverRepository;
    private PickupBatchInterface $pickupBatchRepository;
    private PickupBatchInterface $pickupBatchBranchRepository;


    /**
     * @param BagsInterface $bagsRepository
     */
    public function __construct(
        BagsInterface $bagsRepository,
        BusinessInterface $businessRepository,
        BagStatusInterface $bagStatusRepository,
        DeliveryInterface $deliveryRepository,
        DriverRepository $driverRepository,
        PickupBatchInterface $pickupBatchRepository
    ) {
        $this->businessRepository = $businessRepository;
        $this->bagsRepository = $bagsRepository;
        $this->bagStatusRepository = $bagStatusRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->driverRepository = $driverRepository;
        $this->pickupBatchRepository = $pickupBatchRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function viewAllBags()
    {
        $businesses = $this->businessRepository->getActiveBusinesses();
        $bags = $this->bagsRepository->getBags();
        $context = ["businesses" => $businesses, "bags" => $bags];
        return view('deliveryservice::bags.view_bags', $context);
    }
    public function addBag()
    {
        $businesses = $this->businessRepository->getActiveBusinesses();
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

                $bag = $this->bagsRepository->addNewBag(qrCode: "", business_id: $request->get("business_id"), bagNumber: $request->get("bag_number"), bagSize: $request->get("bag_size"), bagType: $request->get("bag_size"), weight: $request->get("weight"), dimensions: $request->get("dimensions"), status: 'Added');
                QrCode::size(400)->generate($bag->id, $path);
                $this->bagsRepository->updateBag(id: $bag->id, business_id: $bag->business_id, qrCode: $path, bagNumber: $bag->bag_number, bagSize: $bag->bag_size, bagType: $bag->bag_type, status: $bag->status, weight: $bag->weight, dimensions: $bag->dimensions);
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

        $businesses = $this->businessRepository->getActiveBusinesses();
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
        $this->bagsRepository->updateStatus(id: $id, status: $status_id);
    }

    public function unassignedBagsPickup()
    {
        $start_date = '2023-09-24';
        $end_date = '2023-09-25';
        $deliveries = $this->deliveryRepository->getPickupUnassignedDeliveries($start_date, $end_date);
        $drivers = $this->driverRepository->getDetailDrivers();
        $data = ['deliveries' => $deliveries, 'drivers' => $drivers];
        return view('deliveryservice::bags.bags_pickup.unasssigned_bag_pickups', $data);
    }


    public function assignBagsPickup(Request $request)
    {
        $start_date = '2023-09-24';
        $end_date = '2023-09-25';

        try {
            // --------------- GETTING DELIVERIES AND DRIVER TO ASSIGN-------------
            $driver_id = $request->get("driver_id");
            $deliveries = explode(',', $request->get("selected_delivery_ids"));


            // -------------------- CREATING NEW BATCH FOR DELIVERY BASED ON DRIVER id-----------
            $batch = $this->pickupBatchRepository->getActivePickupBatchByDriver($driver_id);
            // ---------------------ASSIGNING DELIVERIES TO BATCH -------------------------
            $this->deliveryRepository->assignPickupBatch($batch->id, $deliveries);

            // Pickup batch branches will be populated from driver app data 
            $drivers = $this->driverRepository->getDetailDrivers();
            $db_deliveries = $this->deliveryRepository->getPickupUnassignedDeliveries($start_date, $end_date);
            $data = ['deliveries' => $db_deliveries, 'drivers' => $drivers];
            return view('deliveryservice::bags.bags_pickup.unasssigned_bag_pickups', $data);
        } catch (Exception $exception) {
            dd($exception);
        }

        return view('deliveryservice::bags.bags_pickup.unasssigned_bag_pickups', ['deliveries' => $deliveries, 'drivers' => $drivers]);
    }

    public function assignedBagsPickup()
    {
        $start_date = '2023-09-24';
        $end_date = '2023-09-25';
        $deliveries = $this->deliveryRepository->getPickupAssignedDeliveries($start_date, $end_date);
        $drivers = $this->driverRepository->getDetailDrivers();
        $data = ['deliveries' => $deliveries, 'drivers' => $drivers];
        return view('deliveryservice::bags.bags_pickup.unasssigned_bag_pickups', $data);
    }
    public function driverBagsPickup(Request $request)
    {
        $start_date = date("Y/m/d");
        $end_date = date("Y-m-d", strtotime($start_date . " +1 day"));;

        try {
            // --------------- GETTING DELIVERIES AND DRIVER TO ASSIGN-------------
            $driver_id = $request->get("driver_id");
            $deliveries = explode(',', $request->get("selected_delivery_ids"));


            // -------------------- CREATING NEW BATCH FOR DELIVERY BASED ON DRIVER id-----------
            $batch = $this->pickupBatchRepository->getActivePickupBatchByDriver($driver_id);
            // ---------------------ASSIGNING DELIVERIES TO BATCH -------------------------
            $this->deliveryRepository->assignPickupBatch($batch->id, $deliveries);

            // Pickup batch branches will be populated from driver app data 
            $drivers = $this->driverRepository->getDetailDrivers();
            $db_deliveries = $this->deliveryRepository->getPickupUnassignedDeliveries($start_date, $end_date);
            $data = ['deliveries' => $db_deliveries, 'drivers' => $drivers];
            return view('deliveryservice::bags.bags_pickup.unasssigned_bag_pickups', $data);
        } catch (Exception $exception) {
            dd($exception);
        }

        return view('deliveryservice::bags.bags_pickup.unasssigned_bag_pickups', ['deliveries' => $deliveries, 'drivers' => $drivers]);
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
