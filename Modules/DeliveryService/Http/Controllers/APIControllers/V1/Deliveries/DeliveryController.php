<?php

namespace Modules\DeliveryService\Http\Controllers\APIControllers\V1\Deliveries;

use App\Enum\BagStatusEnum;
use App\Enum\BusinessWalletTransactionTypeEnum;
use App\Enum\EmptyBagCollectionStatusEnum;
use App\Enum\InvoiceItemTypeEnum;
use App\Enum\BatchStatusEnum;
use App\Enum\BagTypeEnum;
use App\Enum\DeliveryImageTypeEnum;
use App\Enum\DeliveryStatusEnum;
use App\Events\DeliveryCompleted;
use App\Http\Helper\Helper;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\DeliverySlotInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\UserRoleInterface;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Modules\BusinessService\Entities\CustomerAddress;
use Modules\BusinessService\Interfaces\BranchInterface;
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;
use Modules\BusinessService\Interfaces\CustomerInterface;
use Modules\BusinessService\Interfaces\CustomerSecondaryNumberInterface;
use Modules\BusinessService\Interfaces\DeliverySlotPricingInterface;
use Modules\BusinessService\Interfaces\RangePricingInterface;
use Modules\DeliveryService\Http\Exports\DeliveryTemplateClass;
use Modules\DeliveryService\Interfaces\BagTimelineInterface;
use Modules\DeliveryService\Interfaces\DeliveryBagInterface;
use Modules\DeliveryService\Interfaces\DeliveryBatchInterface;
use Modules\DeliveryService\Interfaces\DeliveryImagesInterface;
use Modules\DeliveryService\Interfaces\DeliveryInterface;
use Modules\DeliveryService\Interfaces\DeliveryTypeInterface;
use Modules\DeliveryService\Interfaces\EmptyBagCollectionInterface;
use Modules\DeliveryService\Repositories\PickupBatchRepository;
use Modules\DeliveryService\Rules\BatchStatusRule;
use Modules\FinanceService\Interfaces\BusinessWalletInterface;
use Modules\FinanceService\Interfaces\BusinessWalletTransactionInterface;
use Modules\FinanceService\Interfaces\InvoiceItemInterface;
use Modules\FleetService\Interfaces\DriverAreaInterface;
use Modules\FleetService\Interfaces\DriverInterface;


class DeliveryController extends Controller
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
    private $deliveryImagesRepository;
    private $deliveryBagRepository;
    private $pickupBatchRepository;
    private $rangePricingRepository;
    private $deliverySlotPricingRepository;
    private $invoiceItemRepository;
    private $businessWalletRepository;
    private $businessWalletTransactionRepository;
    private $emptyBagcollectionRepository;
    private $bagTimeRepository;
    private $roleRepository;
    private $userRoleRepository;


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
        DeliveryImagesInterface $deliveryImagesRepository,
        DeliveryBagInterface $deliveryBagRepository,
        PickupBatchRepository $pickupBatchRepository,
        RangePricingInterface $rangePricingRepository,
        DeliverySlotPricingInterface $deliverySlotPricingRepository,
        InvoiceItemInterface $invoiceItemRepository,
        BusinessWalletInterface $businessWalletRepository,
        BusinessWalletTransactionInterface $businessWalletTransactionRepository,
        EmptyBagCollectionInterface $emptyBagcollectionRepository,
        BagTimelineInterface $bagTimeRepository,
        RoleInterface $roleRepository,
        UserRoleInterface $userRoleRepository,
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
        $this->deliveryImagesRepository = $deliveryImagesRepository;
        $this->deliveryBagRepository = $deliveryBagRepository;
        $this->pickupBatchRepository = $pickupBatchRepository;
        $this->rangePricingRepository = $rangePricingRepository;
        $this->deliverySlotPricingRepository = $deliverySlotPricingRepository;
        $this->invoiceItemRepository = $invoiceItemRepository;
        $this->businessWalletRepository = $businessWalletRepository;
        $this->businessWalletTransactionRepository = $businessWalletTransactionRepository;
        $this->emptyBagcollectionRepository = $emptyBagcollectionRepository;
        $this->bagTimeRepository = $bagTimeRepository;
        $this->roleRepository = $roleRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->helper = $helper;
    }


    /**
     * Show the form for creating a new resource.
     */

    public function uploadDeliveriesByForm(Request $request)
    {
        $customers = $request->get("customer");
        $addresses = $request->get("delivery_address");
        $deliverySlots = $request->get("delivery_slot");
        $itemTypes = $request->get("item_type");
        $instructions = $request->get("special_instructions");
        $notes = $request->get("notes");
        $codAmounts = $request->get("cod_amount");

        $totalRecords = count($customers);
        for ($i = 0; $i < $totalRecords; $i++) {
            $customer = $customers[$i];
            $address = $addresses[$i];
            $deliverySlot = $deliverySlots[$i];
            $itemType = $itemTypes[$i];
            $instruction = $instructions[$i];
            $note = $notes[$i];
            $codAmount = $codAmounts[$i];

            //TODO:: store data into database

        }
        return redirect()->route("upload_deliveries")->with("success", "Deliveries uploaded successfully");
    }

    public function generateAndDownloadDeliveryTemplate(Request $request)
    {
        $data = [];
        return Excel::download(new DeliveryTemplateClass($data, $request->get("total_deliveries")), 'delivery_template.xlsx');
    }


    public function uploadDeliveriesByExcel(Request $request)
    {

        $businesses = $this->businessRepository->getActiveBusinesses();

        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $expected_headers = [
            'Phone',
            'Full Name',
            'Email (Optional)',
            'Address',
            'Google Link Address (Optional)',
            'Area with City (Select Option)',
            'Pickup Point',
            'City With Time (Select Option)',
            'Notes',
            'Notification (Select Option)',
            'Product Type (Optional)',
            'CustomerID (Optional)',

        ];
        $file = $request->file('excel_file');
        $delivery_date = $request->delivery_date;

        $data = $this->helper->getExcelSheetData($file);

        // Create chunks of data with 10 rows each
        $chunks = array_chunk($data, 10);

        $header = $chunks[0][0];
        $header = array_map(fn($v) => trim(str_replace([' ', '(', ')'], ['_', '', ''], strtolower(preg_replace('/\(([^)]+)\)/', '$1', $v))), '_'), $header);
        unset($chunks[0][0]);
        $batch = Bus::batch([])->dispatch();
        $conflicted_deliveries = [];
        foreach ($chunks as $key => $chunk) {
            try {
                DB::beginTransaction();

                if ($this->headersMatch($header, $expected_headers)) {
                    foreach ($chunk as $chunk_item_id => $row) {
                        $row = array_combine($header, $row);
                        // $chunks[$key][$chunk_item_id] = $row;
                        // $chunk[$chunk_item_id] = $row;


                        $sheet_area_with_city = $row['area_with_city_select_option'];
                        $city_name = '';
                        $area_name = '';
                        $new_address_coordinates = [];


                        $openingParenthesisPos = strpos($sheet_area_with_city, '(');

                        // ---- 2. Get the sheet area name with city and extract DB ID
                        if ($openingParenthesisPos !== false) {
                            $city_name = substr($sheet_area_with_city, 0, $openingParenthesisPos);
                            $area_name = substr($sheet_area_with_city, $openingParenthesisPos + 1, -1);
                        }
                        $city = $this->cityRepository->searchCityFirst($this->helper->removeExtraSpacesFromString($city_name));
                        $area = $this->areaRepository->searchAreaFirst($this->helper->removeExtraSpacesFromString($area_name));

                        // ---- 3. Get all the addresses ($customer_address) of the db customer of selected city
                        $sheet_address = $row['address'];
                        $customer = $this->customerRepository->customerWithMatchingPhoneNoInUsers($row['phone']);
                        if (!$customer && ($row['email_optional'] != '' || $row['email_optional'] != null)) {
                            $this->customerRepository->customerWithMatchingEmailInUsers($row['email_optional']);
                        }
                        $customer_addresses = '';
                        $address_matching = null;

                        // --- If customer phone already exist in priamry list 
                        if ($customer) {
                            // $customer_with_sec_phon =  $this->customerRepository->customerWithMatchingPhoneNoInSecondaryNumbers($row['phone']); // Will need for dealing with secondary numbers
                            $customer_addresses = $this->customerAddressRepository->getCustomerCityAddresses($customer->id, $city->id);
                            $address_matching = $this->addressDBStatus($sheet_address, $customer_addresses);
                        } else {
                            $user = $this->userRepository->createUser([
                                'name' => $row['full_name'],
                                'email' => $row['email_optional'] ?? null,
                                'phone' => $row['phone'] ?? null,
                                'password' => Hash::make("Aced732nokia501@"),
                                'isActive' => true
                            ], false);


                            $customer = $this->customerRepository->create(['user_id' => $user->id]);
                            $this->businessCustomerRepository->create(customer_id: $customer->id, business_id: $request->business_id);
                            $role_id = $this->roleRepository->getRoleByName(RoleNamesEnum::CUSTOMER->value);
                            $this->userRoleRepository->createUserRole(userId: $user->id, roleId: $role_id->id);
                        }

                        // --- Get DB Branch

                        $branch = $this->branchRepository->getBusinessBranch(['name' => $row['pickup_point']]);
                        $delivery_type = $this->deliveryTypeRepository->getWhereFirst(['name' => $row['product_type_optional']]);

                        $delivery_slot = $this->helper->extractDeliverySlotFromCityWithTime($row['city_with_time_select_option']);
                        // echo ('<pre> delivery_slot below' . $row['city_with_time_select_option'] . ' <pre>');
                        // echo ('<pre> ' . var_dump($delivery_slot->start_time) . ' <pre>');
                        // echo ('<pre> ' . var_dump($delivery_slot->end_time) . ' <pre>');
                        // echo ('<pre> ' . var_dump($city->id) . ' <pre>');

                        $db_delivery_slot = $this->deliverySlotRepository->getDeliverySlotsByTimeAndCity($delivery_slot->start_time, $delivery_slot->end_time, $city->id);



                        $finalized_address = '';

                        $delivery_data = [
                            'status' => DeliveryStatusEnum::UNASSIGNED->value,
                            'is_recurring' => false,
                            'payment_status' => false,
                            'is_sign_required' => false,
                            'is_notification_enabled' => $row['notification_select_option'] == 'Yes' ? 1 : 0,
                            'note' => $row['notes'],
                            'branch_id' => $branch->id ?? null,
                            'delivery_slot_id' => $db_delivery_slot->id ?? null,
                            'delivery_type_id' => null,
                            'delivery_date' => $delivery_date,
                            'customer_id' => $customer->id,
                            'area_id' => $area->id,
                            'city_id' => $city->id,
                            'state_id' => $city->state->id,
                            'country_id' => $city->state->country->id,

                        ];

                        if ($address_matching == null || ($address_matching && $address_matching['status'] == 'MISSING')) {

                            // add new and get customer id
                            $new_address_coordinates = $this->helper->convertStringAddressToCoordinates($sheet_address);

                            $address_data = [
                                'address' => $sheet_address,
                                'address_type' => AddressTypeEnum::DEFAULT ->value,
                                'latitude' => $new_address_coordinates ? $new_address_coordinates->latitude : null,
                                'longitude' => $new_address_coordinates ? $new_address_coordinates->longitude : null,
                                'customer_id' => $customer->id,
                                'address_status' => $new_address_coordinates ? AddressStatusEnum::COORDINATES_MANUAL_APPORVAL_REQUIRED->value : AddressStatusEnum::NO_COORDINATES->value,
                                'area_id' => $area->id,
                                'city_id' => $city->id,
                                'state_id' => $city->state->id,
                                'country_id' => $city->state->country->id,
                            ];
                            $finalized_address = $this->customerAddressRepository->create($address_data);
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
                        }
                        $delivery_data['customer_address_id'] = $finalized_address->id ?? null;
                        // echo ('<pre> ENTERING.... Record no: ' . var_dump($key . ' ' . $chunk_item_id) . '<pre>');
                        // echo ('<pre>' . print_r($delivery_data) . '<pre>');


                        $this->deliveryRepository->create($delivery_data);
                        // TODO: upload deliveries in chunks
                        // $chunks[$key][$chunk_item_id] = $delivery_data;
                        // $chunk[$chunk_item_id] = $delivery_data;
                        // echo ('<pre>' . print_r($chunks[$key][$chunk_item_id]) . '<pre>');



                        // ---- * TODO: Deal with secondary numbers
                        // 0) --- Check if sheet phone is in users DB table (primary number) 
                        // 1) --- If 0.1 true, check if DB name match with sheet name 
                        //      1.1) --- If 1 true, customer uniquily identified ( S U C C E S S )
                        //      1.2) --- If 1 false, check sheet number is in customers secondary numbers DB table 
                        //          1.2.1) --- If 1.2 true, then check corresponding customer DB name matches with users DB table 
                        //              1.2.1.1) --- If 1.2.1 true, then get uniquily identified customer ( S U C C E S S )
                        //              1.2.1.2) --- If 1.2.1 false, then fetch the addresses of DB customer and check if it match sheet address
                        //                  1.2.1.2.1) --- If 1.2.1.2 true, then get uniquily identified customer ( S U C C E S S ) 
                        //                  1.2.1.2.2) --- If 1.2.1.2 false, address match is above 50% and less then 95$ then give the option for manual review ( R E V I E W )
                        //                  1.2.1.2.2) --- If 1.2.1.2 false, address match is less then 50% then add new addreess ( S U C C E S S ) 
                        //          1.2.2) --- If 1.2 false, then add new customer ( S U C C E S S )
                        // 1) --- If 0.1 true, check if DB name match with sheet name 
                    }
                } else {
                    return redirect()->back()->with('error', 'Uploading file is not following excpected excel format.');
                }
                // TODO: upload deliveries via JOB
                // $batch->add(new UploadDeliveriesCSVJob($chunk));
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                return $this->error($e, 'Something went wrong contact support');
            }
        }

        if (count($conflicted_deliveries) == 0) {
            $this->success($data, "Deliveries uploaded successfully");
        } else {
            return $this->error($conflicted_deliveries, count($conflicted_deliveries) . ' deliveries not uploaded.');
        }
        // return redirect()->back()->with('success', 'Valid deliveries uploaded successfully.');
        // return redirect()->route('deliveryservice::deliveries.upload_delivery')->with(['businesses' => $businesses]);
        // return view('deliveryservice::deliveries.upload_delivery', ['businesses' =>  $businesses]);

        // return view('deliveryservice::deliveries.upload_delivery', [
        //     'businesses' => $businesses,
        //     'conflicted_deliveries' => $conflicted_deliveries
        // ]);
    }

    public function uploadSingleDelivery(Request $request)
    {
        return $this->error("Error", 'Something went wrong contact support');
    }

    public function getBusinessCustomer(Request $request)
    {
        return $this->error("Error", 'Something went wrong contact support');
    }

    public function update(Request $request)
    {
        dd("inside update() of DeliveryController" . $request);
        if ($request->ajax()) {
            User::find($request->pk)->update([$request->name => $request->value]);
            return response()->json(['success' => true]);
        }
    }

    public function uploadConflictedDeliveries(Request $request)
    {
        $request_data = $request->all(); // Replace with how you access your request data

        foreach ($request_data['conflicted_delivery'] as $key => $delivery) {
            $delivery_data = $delivery['delivery_data'];
            $decoded_delivery_data = json_decode($delivery_data);
            $address = json_decode($delivery['address']);

            if ($address !== null && is_object($address)) {
                $decoded_delivery_data->address_id = $address->id;
            } else {
                $address = $delivery['address'];

                // add new and get customer id
                $new_address_coordinates = $this->helper->convertStringAddressToCoordinates($address);
                $address_data = [
                    'address' => $address,
                    'address_type' => "OTHER",
                    'latitude' => $new_address_coordinates ? $new_address_coordinates->latitude : null,
                    'longitude' => $new_address_coordinates ? $new_address_coordinates->longitude : null,
                    'customer_id' => $decoded_delivery_data->customer_id,
                    'address_status' => $new_address_coordinates ? "NO_COORDINATES" : "MANUAL_APPORVAL_REQUIRED",
                    'area_id' => $decoded_delivery_data->area_id,
                    'city_id' => $decoded_delivery_data->city_id,
                    'state_id' => $decoded_delivery_data->state_id,
                    'country_id' => $decoded_delivery_data->country_id,
                ];
                $uploaded_address = $this->customerAddressRepository->create($address_data);
                $decoded_delivery_data->address_id = $uploaded_address->id;
            }
            $data = (array) $decoded_delivery_data;

            $this->deliveryRepository->create($data);
        }
        return redirect()->back()->with('success', 'Conflicted deliveries uploaded successfully.');
    }

    public function batch()
    {
        $batchId = request('id');
        return Bus::findBatch($batchId);
    }

    public function batchInProgress()
    {
        $batches = DB::table('job_batches')->where('pending_jobs', '>', 0)->get();
        if (count($batches) > 0) {
            return Bus::findBatch($batches[0]->id);
        }
        return [];
    }


    public function addressDBStatus(...$parameters)
    {

        $passed_address = $parameters[0] ?? null;
        $passed_db_addresses = $parameters[1] ?? null; // List of customer address can be passed from which passed address can be analyzed

        $customer_addresses = $passed_db_addresses;
        $db_address_percent = [];
        if ($customer_addresses == null) {
            $customer_addresses = $this->customerAddressRepository->get();
        }

        // ---- 4. Match the sheet address with $customer_address in db and calculate the percent
        foreach ($customer_addresses as $customer_address) {
            $temp_passed_address = $this->helper->concatWordsIfDoesnotExist($passed_address, [$customer_address->city->name, $customer_address->state->name, $customer_address->country->name]);
            $temp_customer_address = $this->helper->concatWordsIfDoesnotExist($customer_address->address, [$customer_address->city->name, $customer_address->state->name, $customer_address->country->name]);
            $similarity = $this->helper->addressSimilarityPercentage($temp_customer_address, $temp_passed_address);
            array_push($db_address_percent, ['percent' => $similarity, 'address' => $customer_address->address]);

            // Custom sorting function to sort by "percent" in descending order
            usort($db_address_percent, function ($a, $b) {
                return $b['percent'] - $a['percent'];
            });
        }


        $highest_matching_address = !empty($db_address_percent) ? $db_address_percent[0] : [];

        $result = [];
        if (empty($highest_matching_address) || $highest_matching_address['percent'] < 51) {
            // ---- 4.1. Check if highest matching address is exctly the same 
            $result['status'] = "MISSING";
            $result['passed_address'] = $passed_address;
        } else {
            if ($highest_matching_address['percent'] >= 95) {
                $result['status'] = "MATCHED";
                $result['customer_db_address'] = $customer_address;
            } else {
                $result['status'] = "CONFLICT";
                $result['customer_db_address'] = $customer_address;
                $result['passed_address'] = $passed_address;
            }
        }
        return $result;
    }


    //TODO::This function (getAddresses) will be moved to CustomerAddressController

    public function getAddresses(Request $request)
    {
        $selectedCustomer = $request->input('customer');
        // Retrieve delivery addresses for the selected customer
        $deliveryAddresses = CustomerAddress::where('customer', $selectedCustomer)->pluck('address');

        return response()->json(['deliveryAddresses' => $deliveryAddresses]);
    }

    protected function headersMatch($actual_headers, $expected_headers)
    {
        // - Making all words lower case
        // - replace spaces with underscore "_"
        // - remove ONLY round brackets if there are any, NOT the content inside the round brackets 
        $actual_headers = array_map(fn($v) => trim(str_replace([' ', '(', ')'], ['_', '', ''], strtolower(preg_replace('/\(([^)]+)\)/', '$1', $v))), '_'), $actual_headers);
        $expected_headers = array_map(fn($v) => trim(str_replace([' ', '(', ')'], ['_', '', ''], strtolower(preg_replace('/\(([^)]+)\)/', '$1', $v))), '_'), $expected_headers);

        // $actual_headers_lowercase = array_map('strtolower', $actual_headers);
        // $expected_headers_lowercase = array_map('strtolower', $expected_headers);

        sort($actual_headers);
        sort($expected_headers);
        // echo '<pre>';
        // print_r($actual_headers_lowercase);
        // echo '<pre>';
        // echo '<pre>';
        // print_r($expected_headers_lowercase);
        // echo '<pre>';
        // dd();
        return $actual_headers === $expected_headers;
    }

    // ------------------------------------- SUGGESTED DRIVER-----------------------
    function unassigned_deliveries()
    {
        $deliveries = $this->deliveryRepository->getDeliveriesByStatus(DeliveryStatusEnum::UNASSIGNED->value);

        foreach ($deliveries as $delivery) {
            $customerAddress = $this->customerAddressRepository->getCustomerAddressesbyID($delivery->customer_address_id);

            // Step 1: Find a driver that matches the delivery area and has deuty timing eligilable for that slot
            $drivers = $this->driverRepository->getDriversbyAreaID($customerAddress->area_id, $delivery->deliverySlot->start_time, $delivery->deliverySlot->end_time);
            $delivery->setAttribute('suggested_drivers', $drivers);




            // if ($driver) {
            //     // Step 2: Check the last delivery for the customer
            //     $lastDelivery = Delivery::where('customer_id', $delivery->customer_id)
            //         ->where('id', '<', $delivery->id)
            //         ->orderBy('id', 'desc')
            //         ->first();

            //     if ($lastDelivery) {
            //         // If a previous delivery exists, suggest the driver from that delivery
            //         $lastDriver = Driver::find($lastDelivery->driver_id);
            //         $suggestedDriver = $lastDriver;
            //     } else {
            //         // If no previous delivery exists, suggest the driver found in step 1
            //         $suggestedDriver = $driver;
            //     }

            //     // Assign the suggested driver to the delivery
            //     $delivery->suggested_driver_id = $suggestedDriver->id;
            //     $delivery->save();
            // }

        }
        // foreach ($deliveries as $delivery) {
        //     echo ('Delivery : ' . $delivery->deliverySlot->start_time . '-' . $delivery->deliverySlot->end_time . 'area : ' . $delivery->customerAddress->area->name);
        //     echo "<br><br>";
        //     foreach ($delivery->suggested_drivers as $driver) {
        //         echo ('Driver : ' . $driver->employee->first_name . ' - ' . $driver->employee->duty_start_time . '-' . $driver->employee->duty_end_time . ' - ' . $driver->areas->pluck('name'));
        //     }

        //     echo "<br>next delivery<br>";
        // }
        $drivers = $this->driverRepository->getDetailDrivers();
        $data = ['deliveries' => $deliveries, 'drivers' => $drivers];
        return view('deliveryservice::deliveries.unassigned_deliveries', $data);
    }


    public function assignDeliveriesToDriver(Request $request)
    {
        try {
            // --------------- GETTING DELIVERIES AND DRIVER TO ASSIGN-------------
            $driver_id = $request->get("driver_id");
            $deliveries = explode(',', $request->get("selected_delivery_ids"));


            // -------------------- CREATING NEW BATCH FOR DELIVERY BASED ON DRIVER id-----------
            $batch = $this->deliveryBatchRepository->getActiveDeliveryBatchByDriver($driver_id);

            // ---------------------ASSIGNING DELIVERIES TO BATCH -------------------------
            $this->deliveryRepository->assignDeliveryBatch($batch->id, $deliveries);

            echo ($driver_id);
            dd($batch);
            dd($deliveries);
        } catch (Exception $exception) {
            dd($exception);
        }
    }


    public function getAllDeliverySlots(Request $request)
    {
        try {
            $data = $this->deliverySlotRepository->getAllDeliverySlots();
            dd($data);
            return $this->success($data, "Delivery Slots retrieved successfully");
        } catch (Exception $exception) {
            return $this->error($exception, "Something went wrong please contact support");
        }
    }


    // -------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------DRIVER APP ----------------------------------------------
    // -------------------------------------------------------------------------------------------------------------

    public function getDriverDeliveries(Request $request)
    {
        try {
            $driver_id = auth()->user()->driver->id;
            $delivery_batch = $this->deliveryBatchRepository->getDriverActiveBatchWithDeliveries($driver_id);
            $data = ['delivery_batch' => $delivery_batch];
            if (!$data) {
                return $this->error($data, "Error! No deliveries assigned to the driver");
            }
            return $this->success($data, "Delivery batch deliveries");
        } catch (Exception $e) {
            return $this->error($e, 'Something went wrong contact support');
        }
    }



    public function completeDelivery(Request $request)
    {
 
        try {
            // Check if $validator = Validator::make($request->all(), [
            $validator = Validator::make($request->all(), [
                'delivery_id' => ['required', 'exists:deliveries,id'],
                'open_bag_img' => ['required', 'image'],
                'close_bag_img' => ['required', 'image'],
                'delivered_bag_img' => ['required', 'image'],
                'delivery_img' => ['image'],
                'signature_img' => ['image'],
                'address_img' => ['image'],
                'empty_bag_count' => [],
            ]);
            
            // Check if validation fails
            if ($validator->fails()) {
                return $this->error($validator->errors(), "validation failed", 422);
            }
            $delivery_id = $request->post('delivery_id');
            $open_bag_img = $request->file('open_bag_img');
            $close_bag_img = $request->file('close_bag_img');
            $delivered_bag_img = $request->file('delivered_bag_img');
            $delivery_img = $request->file('delivery_img');
            $signature_img = $request->file('signature_img');
            $address_img = $request->file('address_img');
            $empty_bag_count = $request->post('empty_bag_count');

            $delivery = $this->deliveryRepository->getSingleDelivery($delivery_id);
        
            $date = date('Y-m-d');
            // $delivery_count = $this->deliveryRepository->getDeliveredCountOfDays($delivery->branch_id, $date, $date);
            // $range_price = $this->rangePricingRepository->getRangePriceOfDelivery($delivery_count, $delivery->customerAddress->city_id, $delivery->branch->business_id);
            // $delivery_slot_price = $this->deliverySlotPricingRepository->getDeliverySlotPriceOfDelivery($delivery->delivery_slot_id, $delivery->customerAddress->city_id, $delivery->branch->business_id);

            // ----- If no price is set for the city
            // $validator->after(function ($validator) use ($range_price, $delivery_slot_price, $delivery) {
            //     if (is_null($range_price) && is_null($delivery_slot_price)) {
            //         $validator->errors()->add('range_price', "Pricing doesn't exist for city: " . $delivery->customerAddress->city->name);
            //     }
            // });

            // if ($validator->fails()) {
            //     return $this->error($validator->errors(), "validation failed", 422);
            // }
            DB::beginTransaction();

           
                // ----- Deduct amount for delivery 
            // $amount_to_deduct = $delivery_slot_price && $range_price ? min($delivery_slot_price->delivery_price, $range_price->delivery_price) : $delivery_slot_price->delivery_price ?? $range_price->delivery_price;
            // $invoice_item = $this->invoiceItemRepository->createInvoiceItem( item_type:$delivery_slot_price ? InvoiceItemTypeEnum::DELIVERY_SLOT_PRICING->value : InvoiceItemTypeEnum::RANGE_PRICING->value,
            //    amount: $amount_to_deduct,
            //    item_info: $delivery,
            //    service:$delivery // *Polymorph identification
            // );
            
            

            // ----- Updating wallet
            // $business_wallet = $this->businessWalletRepository->getBusinessWallet($delivery->branch->business_id);
            // $this->businessWalletRepository->update($business_wallet->id, ['balance' => $business_wallet->balance - $amount_to_deduct]);
            // $this->businessWalletTransactionRepository->createBusinessWalletTransactions($amount_to_deduct, BusinessWalletTransactionTypeEnum::DEBIT->value, $business_wallet->id, $invoice_item->id);
           


            // ----- Uploading images
            if ($open_bag_img) {
                $open_bag_img_url = $this->helper->storeFile($open_bag_img, "DeliveryServce", "Deliveries");
                $this->deliveryImagesRepository->create(['delivery_id' => $delivery_id, 'image_url' => $open_bag_img_url, 'image_type' => DeliveryImageTypeEnum::OPEN_BAG_IMG->value]);
            }
            if ($close_bag_img) {
                $close_bag_img_url = $this->helper->storeFile($close_bag_img, "DeliveryServce", "Deliveries");
                $this->deliveryImagesRepository->create(['delivery_id' => $delivery_id, 'image_url' => $close_bag_img_url, 'image_type' => DeliveryImageTypeEnum::CLOSE_BAG_IMG->value]);
            }
            if ($delivered_bag_img) {
                $delivered_bag_img_url = $this->helper->storeFile($delivered_bag_img, "DeliveryServce", "Deliveries");
                $this->deliveryImagesRepository->create(['delivery_id' => $delivery_id, 'image_url' => $delivered_bag_img_url, 'image_type' => DeliveryImageTypeEnum::DELIVERED_BAG_IMG->value]);
            }
            if ($delivery_img) {
                $delivery_img_url = $this->helper->storeFile($delivery_img, "DeliveryServce", "Deliveries");
                $this->deliveryImagesRepository->create(['delivery_id' => $delivery_id, 'image_url' => $delivery_img_url, 'image_type' => DeliveryImageTypeEnum::DELIVERY_IMG->value]);
            }
            if ($signature_img) {
                $signature_img_url = $this->helper->storeFile($signature_img, "DeliveryServce", "Deliveries");
                $this->deliveryImagesRepository->create(['delivery_id' => $delivery_id, 'image_url' => $signature_img_url, 'image_type' => DeliveryImageTypeEnum::SIGNATURE_IMG->value]);
            }
            if ($address_img) {
                $address_img_url = $this->helper->storeFile($address_img, "DeliveryServce", "Deliveries");
                $this->deliveryImagesRepository->create(['delivery_id' => $delivery_id, 'image_url' => $address_img_url, 'image_type' => DeliveryImageTypeEnum::ADDRESS_IMG->value]);
            }

            // ---- As bag is delivered, it need to be collected, hence adding it in empty bag collections 
            // $delivery_bag = $this->deliveryBagRepository->getDeliveryBagOfDelivery($delivery->id);
            
            // if ($delivery->bag_type == BagTypeEnum::COLLER_BAG->value) {
            //     $this->emptyBagcollectionRepository->createBagCollection(
            //         [
            //             'status' => EmptyBagCollectionStatusEnum::UNASSIGNED->value,
            //             'bag_id' => null,
            //             'delivery_id' => $delivery_id,
            //             'customer_id' => $delivery->customer_id,
            //             'customer_address_id' => $delivery->customer_address_id,
            //         ]
            //     );
            // }

            $data = $this->deliveryRepository->updateDelivery($delivery_id, [
                'status' => DeliveryStatusEnum::DELIVERED->value,
                'empty_bag_count' => $empty_bag_count,
            ]);



            if (!$data) {
                return $this->error($data, "Something went wrong please contact support, Delivery not completed");
            
            }

            DB::commit();
            event(new DeliveryCompleted($delivery));
            return $this->success($data, "Delivery completed successfully");
        } catch (Exception $exception) {
            DB::rollback();
            dd($exception);
            return $this->error($exception, "Something went wrong please contact support");
        }
    }

    // --------------------------------------------------- P I C K   U P  ----------------------------------------------


    public function driverAssignedPickup(Request $request)
    {
        // $start_date = date("Y/m/d");
        // $end_date = date("Y-m-d", strtotime($start_date . " +1 day"));
        $start_date = '2022-09-24';
        $end_date = '2024-11-10';

        try {
            $driver_id = $request->get("driver_id");
            $batch = $this->pickupBatchRepository->getPickupBatchByDriver($driver_id);
            $db_deliveries = $this->deliveryRepository->getDriverPickupAssignedDeliveries($start_date, $end_date, $batch->id);
            $grouped_deliveries = [];

            // Iterate over the data
            foreach ($db_deliveries as $delivery) {
                $branchId = $delivery['branch_id'];

                // Check if the branch_id already exists in $grouped_deliveries
                $found = false;
                foreach ($grouped_deliveries as &$groupedDelivery) {
                    if ($groupedDelivery['branch_id'] === $branchId) {
                        $exist = $this->deliveryBagRepository->isDeliveryReccordExist($delivery->id);
                        // If branch_id exists, increment the assigned_deliveries count
                        $groupedDelivery['assigned_pickups']++;
                        if (!$exist) {
                            $groupedDelivery['pending_pickups']++;
                        }
                        $found = true;
                        break;
                    }
                }

                // If branch_id doesn't exist in $grouped_deliveries, add it as a new entry
                if (!$found) {
                    $exist = $this->deliveryBagRepository->isDeliveryReccordExist($delivery->id);
                    $grouped_deliveries[] = [
                        'pickup_batch_id' => $batch->id,
                        'branch_id' => $delivery->branch_id,
                        'branch_name' => $delivery->branch->name, // You can populate branch name here if available
                        'assigned_pickups' => 1, // Initialize with 1 for the first record
                        'pending_pickups' => $exist ? 0 : 1,
                    ];
                }
            }



            // foreach ($db_deliveries as $delivery) {
            //     $branchId = $delivery['branch_id'];

            //     // Check if the branch ID exists in the grouped array
            //     if (!isset($grouped_deliveries[$branchId])) {
            //         // If it doesn't exist, initialize an empty array for that branch
            //         $grouped_deliveries[$branchId] = [];
            //     }

            //     // Add the current delivery to the branch's array
            //     $grouped_deliveries[$branchId][] = $delivery;
            // }

            // Now $grouped_deliveries contains deliveries grouped by branch ID

            // If you want to convert it to JSON
            // $grouped_deliveriesJSON = json_encode(['data' => $grouped_deliveries]);
            if (!$grouped_deliveries) {
                return $this->error($grouped_deliveries, "Something went wrong please contact support. No bag pickups for driver");
            }

            return $this->success($grouped_deliveries, "Drivers partner wise assigned pickup  recieved successfully");
        } catch (Exception $exception) {
            dd($exception);
            return $this->error($exception, "Something went wrong please contact support");
        }
    }

    public function driverPendingPickups(Request $request)
    {
        // $end_date = date("Y-m-d", strtotime($start_date . " +1 day"));
        $start_date = '2023-09-24';
        $end_date = '2023-10-10';

        try {
            $driver_id = $request->get("driver_id");
            $branch_id = $request->get("branch_id");

            $batch = $this->pickupBatchRepository->getDriverActiveBatchWithDeliveries($driver_id);
            $db_deliveries = $this->deliveryRepository->getDriverPendingBranchPickups($driver_id, $batch->id, $branch_id);
            // $db_deliveries = $this->deliveryRepository->getDriverPickupAssignedDeliveries($start_date, $end_date, $batch->id);

            if (!$db_deliveries) {
                return $this->error($db_deliveries, "Something went wrong please contact support. No bag pickups for driver");
            }
            return $this->success($db_deliveries, "Drivers assigned pickup bags recieved successfully");
        } catch (Exception $exception) {
            return $this->error($exception, "Something went wrong please contact support");
        }
    }

    public function driverCompletedPickups(Request $request)
    {
        // $end_date = date("Y-m-d", strtotime($start_date . " +1 day"));
        $start_date = '2023-09-24';
        $end_date = '2023-10-10';

        try {
            $driver_id = $request->get("driver_id");
            $branch_id = $request->get("branch_id");

            $batch = $this->pickupBatchRepository->getDriverActiveBatchWithDeliveries($driver_id);
            $db_deliveries = $this->deliveryRepository->getDriverCompletedBranchPickups($driver_id, $batch->id, $branch_id);
            // $db_deliveries = $this->deliveryRepository->getDriverPickupAssignedDeliveries($start_date, $end_date, $batch->id);

            if (!$db_deliveries) {
                return $this->error($db_deliveries, "Something went wrong please contact support. No completed bag pickups for driver");
            }

            return $this->success($db_deliveries, "Drivers completed pickup bags recieved successfully");
        } catch (Exception $exception) {
            dd($exception);
            return $this->error($exception, "Something went wrong please contact support");
        }
    }

    public function linkBagWithDelivery(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'delivery_id' => ['required', 'exists:deliveries,id'],
                'bag_id' => ['required', 'exists:bags,id'],
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return $this->error($validator->errors(), "Validation Failed", 422);
            }

            $delivery_id = $request->get('delivery_id');
            $bag_id = $request->get('bag_id');
            $data = [
                "delivery_id" => $delivery_id,
                "bag_id" => $bag_id
            ];

            // --- Link bag with delivery
            $result = $this->deliveryBagRepository->create($data);

            if (!$result) {
                return $this->error($result, "Something went wrong. Bag did not link");
            }

            DB::commit();
            return $this->success($result, "Bag linked successfully");
        } catch (Exception $exception) {
            dd($exception);
            DB::rollback();
            return $this->error($exception, "Something went wrong please contact support");
        }
    }

    public function updatePickupBatchpProgress(Request $request)
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

            $result = $this->pickupBatchRepository->updatePickupBatch($pickup_batch_id, $data);

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
