<?php

namespace Modules\DeliveryService\Http\Controllers\Bags;

use App\Enum\BagStatusEnum;
use App\Enum\EmptyBagCollectionStatusEnum;
use App\Http\Helper\Helper;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\DeliveryService\Entities\PickupBatch;
use Modules\DeliveryService\Interfaces\BagsInterface;
use Modules\DeliveryService\Interfaces\BagStatusInterface;
use Modules\DeliveryService\Interfaces\PickupBatchInterface;
use Modules\FleetService\Repositories\DriverRepository;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\DeliverySlotInterface;
use App\Interfaces\UserInterface;
use App\Models\DeliverySlot;
use Modules\BusinessService\Interfaces\BranchInterface;
use Modules\BusinessService\Interfaces\BusinessCategoryInterface;
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;
use Modules\BusinessService\Interfaces\CustomerInterface;
use Modules\BusinessService\Interfaces\CustomerSecondaryNumberInterface;
use Modules\DeliveryService\Http\Exports\DeliveryTemplateClass;
use Modules\DeliveryService\Interfaces\DeliveryBagInterface;
use Modules\DeliveryService\Interfaces\DeliveryBatchInterface;
use Modules\DeliveryService\Interfaces\DeliveryInterface;
use Modules\DeliveryService\Interfaces\DeliveryTimelineInterface;
use Modules\DeliveryService\Interfaces\DeliveryTypeInterface;
use Modules\DeliveryService\Interfaces\EmptyBagCollectionBatchInterface;
use Modules\DeliveryService\Interfaces\EmptyBagCollectionInterface;
use Modules\FleetService\Interfaces\DriverAreaInterface;
use Modules\FleetService\Interfaces\DriverInterface;
use PHPUnit\TextUI\Help;

class BagsController extends Controller
{
    private $customerRepository;
    private $cityRepository;
    private $areaRepository;
    private $customerAddressRepository;
    private $deliverySlotRepository;
    private $customerSecondaryNumberRepository;
    private $userRepository;
    private $branchRepository;
    private $BusinessCategoryRepository;
    private $businessCustomerRepository;
    private $deliveryTypeRepository;
    private $helper;
    private $driverAreaRepository;
    private $deliveryBatchRepository;
    private $deliveryTimelineRepository;
    private $deliveryBagsRepository;
    private $bagsRepository;
    private $businessRepository;
    private $bagStatusRepository;
    private $deliveryRepository;
    private $driverRepository;
    private $pickupBatchRepository;
    private $pickupBatchBranchRepository;
    private $emptyBagCollectionRepository;
    private $emptyBagCollectionBatchRepository;



    /**
     * @param BagsInterface $bagsRepository
     */
    public function __construct(
        BagsInterface $bagsRepository,
        BagStatusInterface $bagStatusRepository,
        DeliveryInterface $deliveryRepository,
        DriverRepository $driverRepository,
        PickupBatchInterface $pickupBatchRepository,
        CustomerInterface $customerRepository,
        CityInterface $cityRepository,
        AreaInterface $areaRepository,
        CustomerAddressInterface $customerAddressRepository,
        DeliverySlotInterface $deliverySlotRepository,
        CustomerSecondaryNumberInterface $customerSecondaryNumberRepository,
        UserInterface $userRepository,
        BranchInterface $branchRepository,
        BusinessInterface $businessRepository,
        BusinessCategoryInterface $businessCategoryRepository,
        BusinessCustomerInterface $businessCustomerRepository,
        DeliveryTypeInterface $deliveryTypeRepository,
        DriverAreaInterface $driverAreaRepository,
        DeliveryBatchInterface $deliveryBatchRepository,
        DeliveryTimelineInterface $deliveryTimelineRepository,
        DeliveryBagInterface $deliveryBagsRepository,
        EmptyBagCollectionInterface $emptyBagCollectionRepository,
        EmptyBagCollectionBatchInterface $emptyBagCollectionBatchRepository,

        Helper $helper,

    ) {
        $this->businessRepository = $businessRepository;
        $this->bagsRepository = $bagsRepository;
        $this->bagStatusRepository = $bagStatusRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->driverRepository = $driverRepository;
        $this->pickupBatchRepository = $pickupBatchRepository;
        $this->customerRepository = $customerRepository;
        $this->cityRepository = $cityRepository;
        $this->areaRepository = $areaRepository;
        $this->customerAddressRepository = $customerAddressRepository;
        $this->deliverySlotRepository = $deliverySlotRepository;
        $this->userRepository = $userRepository;
        $this->customerSecondaryNumberRepository = $customerSecondaryNumberRepository;
        $this->branchRepository = $branchRepository;
        $this->businessRepository = $businessRepository;
        $this->BusinessCategoryRepository = $businessCategoryRepository;
        $this->businessCustomerRepository = $businessCustomerRepository;
        $this->deliveryTypeRepository = $deliveryTypeRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->driverAreaRepository = $driverAreaRepository;
        $this->driverRepository = $driverRepository;
        $this->deliveryBatchRepository = $deliveryBatchRepository;
        $this->deliveryTimelineRepository = $deliveryTimelineRepository;
        $this->deliveryBagsRepository = $deliveryBagsRepository;
        $this->emptyBagCollectionRepository = $emptyBagCollectionRepository;
        $this->emptyBagCollectionBatchRepository = $emptyBagCollectionBatchRepository;

        $this->helper = $helper;
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
                $bag = $this->bagsRepository->addNewBag(
                    qrCode: "",
                    business_id: $request->get("business_id"),
                    bagNumber: $request->get("bag_number"),
                    bagSize: $request->get("bag_size"),
                    bagType: $request->get("bag_size"),
                    weight: $request->get("weight"),
                    dimensions: $request->get("dimensions"),
                    status: BagStatusEnum::NEUTRAL->value
                );
                $qr_data = json_encode([
                    'bag_id' => $bag->id,
                    'type' => 'bag',
                ]);
                QrCode::size(400)->generate($qr_data, $path);
                $this->bagsRepository->updateBag(
                    id: $bag->id,
                    business_id: $bag->business_id,
                    qrCode: $path,
                    bagNumber: $bag->bag_number,
                    bagSize: $bag->bag_size,
                    bagType: $bag->bag_type,
                    status: $bag->status,
                    weight: $bag->weight,
                    dimensions: $bag->dimensions
                );
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
        $bags = $this->businessRepository->getBusiness($business_id)->get();

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
        $end_date = '2023-12-25';
        $time_slot = $this->deliverySlotRepository->getAllDeliverySlots()->toArray();
        $businesses = $this->businessRepository->getActiveBusinesses();
        $deliveries = $this->deliveryRepository->getPickupUnassignedDeliveries($start_date, $end_date);
        $emirate = $this->cityRepository->getActiveCities();
        // Sort the time slots based on start_time
        usort($time_slot, function ($a, $b) {
            return strcmp($a['start_time'], $b['start_time']);
        });

        foreach ($deliveries as $delivery) {
            $customerAddress = $delivery->customerAddress;

            // Step 1: Find a driver that matches the delivery area and has duty timing eligilable for that slot
            $drivers = $this->driverRepository->getDriversbyAreaID($customerAddress->area_id, $delivery->deliverySlot->start_time, $delivery->deliverySlot->end_time);
            $delivery->setAttribute('suggested_drivers', $drivers);
        }

        // foreach ($deliveries as $delivery) {
        //     echo ('Delivery : ' . $delivery->deliverySlot->start_time . '-' . $delivery->deliverySlot->end_time . 'area : ' . $delivery->customerAddress->area->name);
        //     echo "<br><br>";
        //     foreach ($delivery->suggested_drivers as $driver) {
        //         echo ('Driver : ' . $driver->employee->first_name . ' - ' . $driver->employee->duty_start_time . '-' . $driver->employee->duty_end_time . ' - ' . $driver->areas->pluck('name'));
        //     }

        //     echo "<br>next delivery<br>";
        // }
        // $drivers = $this->driverRepository->getDriversbyAreaID($customerAddress->area_id, $delivery->deliverySlot->start_time, $delivery->deliverySlot->end_time);
        // $delivery->setAttribute('suggested_drivers', $drivers);


        $drivers = $this->driverRepository->getDetailDrivers();
        $data = [
            'deliveries' => $deliveries,
            'drivers' => $drivers,
            'partners' => $businesses,
            'time_slot' => $time_slot,
            'emirate' => $emirate
        ];
        return view('deliveryservice::bags.bags_pickup.unassigned_bag_pickups', $data);
    }


    public function completedBagsPickup()
    {


        $start_date = '2023-09-24';
        $end_date = '2023-12-25';
        $deliveries = $this->deliveryRepository->getCompletedPickupDeliveries($start_date, $end_date);
        $drivers = $this->driverRepository->getDetailDrivers();
        $data = ['deliveries' => $deliveries, 'drivers' => $drivers];
        return view('deliveryservice::bags.bags_pickup.completed_bag_pickups', $data);
    }


    public function assignBagsPickup(Request $request)
    {
        // $start_date = '2023-09-24';
        // $end_date = '2023-12-25';

        // try {
        //     // --------------- GETTING DELIVERIES AND DRIVER TO ASSIGN-------------
        //     $driver_id = $request->get("driver_id");
        //     $deliveries = explode(',', $request->get("selected_delivery_ids"));

        //     // -------------------- CREATING NEW BATCH FOR DELIVERY BASED ON DRIVER id-----------
        //     $batch = $this->pickupBatchRepository->getActivePickupBatchByDriver($driver_id);
        //     // ---------------------ASSIGNING DELIVERIES TO BATCH -------------------------
        //     $this->deliveryRepository->assignPickupBatch($batch->id, $deliveries);


        //     // Pickup batch branches will be populated from driver app data 
        //     $drivers = $this->driverRepository->getDetailDrivers();
        //     $db_deliveries = $this->deliveryRepository->getPickupUnassignedDeliveries($start_date, $end_date);
        //     $data = ['deliveries' => $db_deliveries, 'drivers' => $drivers];
        //     return view('deliveryservice::bags.bags_pickup.unassigned_bag_pickups', $data)->with("success", "Pickup assigned successfully");
        // } catch (Exception $exception) {
        //     dd($exception);
        // }
        try {
            // --------------- GETTING DELIVERIES AND DRIVER TO ASSIGN-------------
            $driver_id = $request->get("driver_id");
            // $deliveries = explode(',', $request->get("selected_delivery_ids"));
            $deliveries = $request->get("selected_delivery_ids");

            // -------------------- CREATING NEW BATCH FOR DELIVERY BASED ON DRIVER id-----------
            $batch = $this->pickupBatchRepository->getActivePickupBatchByDriver($driver_id);

            // ---------------------ASSIGNING DELIVERIES TO BATCH -------------------------
            $this->deliveryRepository->assignPickupBatch($batch->id, $deliveries);
            return response()->json(['success' => 'Pickup Assigned Successfully', 'redirect_url' => route('unassigned_bags_pickup')]);
        } catch (Exception $exception) {
            dd($exception);
        }
    }

    public function assignedBagsPickup()
    {
        $start_date = '2023-09-24';
        $end_date = '2023-12-25';
        $deliveries = $this->deliveryRepository->getPickupAssignedDeliveries($start_date, $end_date);
        $drivers = $this->driverRepository->getDetailDrivers();
        $data = ['deliveries' => $deliveries, 'drivers' => $drivers];
        return view('deliveryservice::bags.bags_pickup.assigned_bag_pickups', $data);
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
            return view('deliveryservice::bags.bags_pickup.unassigned_bag_pickups', $data);
        } catch (Exception $exception) {
            dd($exception);
        }

        return view('deliveryservice::bags.bags_pickup.unassigned_bag_pickups', ['deliveries' => $deliveries, 'drivers' => $drivers]);
    }

    // ==============================================================================================
    // ====================================== B A G   C O L L E C T I O N =========================== 
    // ==============================================================================================
    public function uploadBagsCollection(Request $request)
    {

        $businesses = $this->businessRepository->getActiveBusinesses();
        $areas = $this->areaRepository->getAllAreas();
        $customers = $this->customerRepository->get();

        $time_slot = $this->deliverySlotRepository->getAllDeliverySlots()->toArray();
        $product_type = $this->BusinessCategoryRepository->getBusinessCategory();
        usort($time_slot, function ($a, $b) {
            return strcmp($a['start_time'], $b['start_time']);
        });
        $time_slot = DeliverySlot::hydrate($time_slot);
        // $business = $this->businessRepository->getBusiness('9a4582c0-3b80-4cda-9208-1ab771756965');
        $data = [
            'businesses' => $businesses,
            'areas' => $areas,
            'time_slot' => $time_slot,
            'product_type' => $product_type,
            'customers' => $customers,

            // 'business' => $business
        ];
        return view('deliveryservice::bags.bags_collection.upload_bags_collection', $data);
    }

    public function storeBagsCollection(Request $request)
    {


        // $request->validate([
        //     'kt_docs_repeater_advanced.*.delivery_name' => 'required|string|max:255',
        //     'kt_docs_repeater_advanced.*.phone_number' => 'required',
        //     'kt_docs_repeater_advanced.*.area' => 'required',
        //     'kt_docs_repeater_advanced.*.emirates_with_time' => 'required',
        //     'kt_docs_repeater_advanced.*.datepicker' => 'required|date',
        //     // 'kt_docs_repeater_advanced.*.company_delivery_id' => 'required|string|max:255',
        //     // 'kt_docs_repeater_advanced.*.delivery_amount' => 'required|numeric',
        //     'kt_docs_repeater_advanced.*.signature' => 'required|in:0,1',
        //     'kt_docs_repeater_advanced.*.notification' => 'required|in:0,1',
        //     'kt_docs_repeater_advanced.*.branch_dropdown' => 'required|string|max:255',
        //     'kt_docs_repeater_advanced.*.delivery_address' => 'required|string|max:255',
        //     'kt_docs_repeater_advanced.*.product_type' => 'required',
        //     // 'kt_docs_repeater_advanced.*.notes' => 'string|max:255',
        //     // 'kt_docs_repeater_advanced.*.google_link_address' => 'required|url',
        // ], [
        //     'kt_docs_repeater_advanced.*.delivery_name.required' => 'Delivery name is required',
        //     'kt_docs_repeater_advanced.*.phone_number.required' => 'Phone number is required',
        //     'kt_docs_repeater_advanced.*.area.required' => 'Area is required',
        //     'kt_docs_repeater_advanced.*.emirates_with_time.required' => 'Emirates with time is required',
        //     'kt_docs_repeater_advanced.*.datepicker.required' => 'Date is required',
        //     // 'kt_docs_repeater_advanced.*.company_delivery_id.required' => 'Company Delivery ID is required',
        //     // 'kt_docs_repeater_advanced.*.delivery_amount.required' => 'Delivery Amount is required',
        //     'kt_docs_repeater_advanced.*.signature.required' => 'Signature is required',
        //     'kt_docs_repeater_advanced.*.notification.required' => 'Notification is required',
        //     'kt_docs_repeater_advanced.*.branch_dropdown.required' => 'Pickup Address is required',
        //     'kt_docs_repeater_advanced.*.delivery_address.required' => 'Delivery Address is required',
        //     'kt_docs_repeater_advanced.*.product_type.required' => 'Product Type is required',
        //     // 'kt_docs_repeater_advanced.*.notes.required' => 'Notes are required',
        //     // 'kt_docs_repeater_advanced.*.google_link_address.required' => 'Google Link Address is required',
        // ]);
        $repeaterData = $request->input('kt_docs_repeater_advanced.*');
        //form can be multiple, making this like to accept multiform value
        // dd($repeaterData);
        foreach ($repeaterData as $row) {
            // Process the data for each row
            $name = $row['delivery_name'];
            // Country code will be dynamically passed
            $phone_number = new PhoneNumber($row['phone_number'], 'PK');
            $phone_number =  $phone_number->formatE164();
            $area = $row['area'];
            $emiratesWithTime = $row['emirates_with_time'];
            $delivery_date = $row['datepicker'];
            // $companyDeliveryId = $row['company_delivery_id'];
            $deliveryAmount = $row['delivery_amount'];
            $signature = $row['signature'];
            $notification = $row['notification'];
            $branch_id = $row['branch_dropdown'];
            $deliveryAddress = $row['delivery_address'];
            $productType = $row['product_type'];
            $notes = $row['notes'];
            $businessIdInput = $row['business_id'];
            $googleLinkAddress = !empty($row['google_link_address']) ? $row['google_link_address'] : null;
            $conflicted_deliveries = [];
            // try {
            //     DB::beginTransaction();
            $area = $this->areaRepository->getAreaById($area);
            $city = $area->city;
            $customer = $this->customerRepository->customerWithMatchingPhoneNoInUsers($phone_number);
            // $customer = $customer ?? $this->customerRepository->customerWithMatchingEmailInUsers($row['email_optional']);
            $customer_addresses = '';
            $address_matching = null;
            // --- If customer phone already exist in priamry list 
            if ($customer) {
                // $customer_with_sec_phon =  $this->customerRepository->customerWithMatchingPhoneNoInSecondaryNumbers($row['phone']); // Will need for dealing with secondary numbers
                $customer_addresses = $this->customerAddressRepository->getCustomerCityAddresses($customer->id, $city->id);
                $address_matching = $this->addressDBStatus($deliveryAddress, $customer_addresses);
            } else {
                $user = $this->userRepository->createUser([
                    'name' => $name,
                    'phone' => $phone_number,
                    'password' => Hash::make("1234abcd"),
                    'is_active' => true
                ], false);
                $customer = $this->customerRepository->create(['user_id' => $user->id]);
                $this->businessCustomerRepository->create(['customer_id' => $customer->id, 'business_id' => $businessIdInput]);
                // $this->businessCustomerRepository->create(['customer_id' => $customer->id, 'business_id' => $request->business_id]);
            }

            $delivery_type = $this->deliveryTypeRepository->getWhereFirst(['name' => $productType]);
            // $db_delivery_slot = $this->deliverySlotRepository->getDeliverySlotsByTimeAndCity($emiratesWithTime->start_time, $emiratesWithTime->end_time, $city->id);

            $finalized_address = '';



            $delivery_data = [
                'status' => 'UNASSIGN',
                'is_recurring' => false,
                'payment_status' => false,
                'is_sign_required' => $signature,
                'is_notification_enabled' => $notification,
                'note' => $notes,
                'branch_id' => $branch_id ?? null,
                'delivery_slot_id' => $emiratesWithTime,
                'delivery_type_id' => null,
                'delivery_date' => $delivery_date,
                'customer_id' => $customer->id,
                'area_id' => $area->id,
                'city_id' => $city->id,
                'state_id' => $city->state->id,
                'country_id' => $city->state->country->id,

            ];

            $delivery_data['customer_address_id'] = null; // Initialize to null
            if ($address_matching == null || ($address_matching && $address_matching['status'] == 'MISSING')) {

                // add new and get customer id
                $new_address_coordinates = $this->helper->convertStringAddressToCoordinates($deliveryAddress);

                $address_data = [
                    'address' => $deliveryAddress,
                    'address_type' => "OTHER",
                    'latitude' => $new_address_coordinates ? $new_address_coordinates->latitude : null,
                    'longitude' => $new_address_coordinates ? $new_address_coordinates->longitude : null,
                    'customer_id' => $customer->id,
                    'address_status' => $new_address_coordinates ? "NO_COORDINATES" : "MANUAL_APPORVAL_REQUIRED",
                    'area_id' => $area->id,
                    'city_id' => $city->id,
                    'state_id' => $city->state->id,
                    'country_id' => $city->state->country->id,
                ];
                $finalized_address = $this->customerAddressRepository->create($address_data);
                $delivery_data['customer_address_id'] = $finalized_address->id; // Update based on condition
                $this->deliveryRepository->create($delivery_data);
            } elseif ($address_matching['status'] == 'CONFLICT') {
                $location_info = [
                    'area_id' => $area->id,
                    'city_id' => $city->id,
                    'state_id' => $city->state->id,
                    'country_id' => $city->state->country->id,
                ];
                $delivery_data = array_merge($delivery_data, $location_info);
                $conflicted_delivery = [
                    'conflict' => 'Similar address for customer already exists',
                    'db_customer' => $customer,
                    'customer_db_address' => $address_matching['customer_db_address'],
                    'passed_address' => $address_matching['passed_address'],
                    'passed_delivery_data' => $delivery_data,
                ];
                array_push($conflicted_deliveries, $conflicted_delivery);
                continue;
            } elseif ($address_matching['status'] == 'MATCHED') {
                $finalized_address = $address_matching['customer_db_address'];
                $delivery_data['customer_address_id'] = $finalized_address->id;
                $this->deliveryRepository->create($delivery_data);
            } else {
            }

            $delivery_data['customer_address_id'] = $finalized_address->id;
            $this->deliveryRepository->create($delivery_data);




            // } catch (Exception $e) {
            //     DB::rollback();
            //     return 'Delivery Data upload failed: ' . $e->getMessage();
            // }
        }

        if (count($conflicted_deliveries) == 0) {
            return redirect()->back()->with('success', 'Valid deliveries uploaded successfully.');
        } else {
            return view('deliveryservice::deliveries.conflicted_deliveries', ['conflicted_deliveries' => $conflicted_deliveries]);
        }
        return $this->unassignedDeliveries();


        // $name = $request->input('kt_docs_repeater_advanced.0.delivery_name');
        // $phone_number = $request->input('kt_docs_repeater_advanced.0.phone_number');
        // $area = $request->input('kt_docs_repeater_advanced.0.area');
        // $emiratesWithTime = $request->input('kt_docs_repeater_advanced.0.emirates_with_time');
        // $datepicker = $request->input('kt_docs_repeater_advanced.0.datepicker');
        // $companyDeliveryId = $request->input('kt_docs_repeater_advanced.0.company_delivery_id');
        // $deliveryAmount = $request->input('kt_docs_repeater_advanced.0.delivery_amount');
        // $signature = $request->input('kt_docs_repeater_advanced.0.signature');
        // $notification = $request->input('kt_docs_repeater_advanced.0.notification');
        // $pickup_address = $request->input('kt_docs_repeater_advanced.0.pickup_address');
        // $deliveryAddress = $request->input('kt_docs_repeater_advanced.0.delivery_address');
        // $productType = $request->input('kt_docs_repeater_advanced.0.product_type');
        // $notes = $request->input('kt_docs_repeater_advanced.0.notes');
        // $googleLinkAddress = $request->input('kt_docs_repeater_advanced.0.google_link_address');

        // dd(
        //     $name,
        //     $phone_number,
        //     $area,
        //     $emiratesWithTime,
        //     $datepicker,
        //     $companyDeliveryId,
        //     $deliveryAmount,
        //     $signature,
        //     $notification,
        //     $pickup_address,
        //     $deliveryAddress,
        //     $productType,
        //     $notes,
        //     $googleLinkAddress
        // );

    }

    public function unassignedBagsCollection()
    {
        $empty_bags_collection = $this->emptyBagCollectionRepository->getBagCollectionWhere(['status' => EmptyBagCollectionStatusEnum::UNASSIGNED->value]);
        $time_slot = $this->deliverySlotRepository->getAllDeliverySlots()->toArray();
        $businesses = $this->businessRepository->getActiveBusinesses();
        $emirate = $this->cityRepository->getActiveCities();
        $drivers = $this->driverRepository->getDrivers();

        $data = [
            'drivers' => $drivers,
            'partners' => $businesses,
            'time_slot' => $time_slot,
            'emirate' => $emirate,
            'empty_bags_collection' => $empty_bags_collection,

        ];

        return view('deliveryservice::bags.bags_collection.unasssigned_bag_collection', $data);
    }



    public function assignBagsCollection(Request $request)
    {
        try {
            // --------------- GETTING DELIVERIES AND DRIVER TO ASSIGN-------------
            $driver_id = $request->get("driver_id");
            // $deliveries = explode(',', $request->get("selected_delivery_ids"));
            $empty_bag_collections = $request->get("selected_empty_bag_collection_ids");

            // -------------------- CREATING NEW BATCH FOR DELIVERY BASED ON DRIVER id-----------
            $batch = $this->emptyBagCollectionBatchRepository->getActiveDeliveryBatchByDriver($driver_id);

            // ---------------------ASSIGNING DELIVERIES TO BATCH -------------------------
            $this->emptyBagCollectionRepository->assignCollectionBatch($batch->id, $empty_bag_collections);

            return $this->unassignedBagsCollection();
        } catch (Exception $exception) {
            dd($exception);
        }
    }

    public function assignedBagsCollection()
    {
        $empty_bags_collection = $this->emptyBagCollectionRepository->getBagCollectionWhere(['status' => EmptyBagCollectionStatusEnum::ASSIGNED->value]);
        $time_slot = $this->deliverySlotRepository->getAllDeliverySlots()->toArray();
        $businesses = $this->businessRepository->getActiveBusinesses();
        $emirate = $this->cityRepository->getActiveCities();
        $drivers = $this->driverRepository->getDrivers();

        $data = [
            'drivers' => $drivers,
            'partners' => $businesses,
            'time_slot' => $time_slot,
            'emirate' => $emirate,
            'empty_bags_collection' => $empty_bags_collection,

        ];

        return view('deliveryservice::bags.bags_collection.assigned_bags_collection', $data);
    }


    public function getCustomerEmptyBagCollection($customer_id)
    {
        $customer_empty_bags = $this->deliveryBagsRepository->getCustomerDeliveryBags($customer_id);

        return response()->json($customer_empty_bags);
    }
}
