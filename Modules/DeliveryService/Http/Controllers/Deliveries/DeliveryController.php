<?php

namespace Modules\DeliveryService\Http\Controllers\Deliveries;

use App\Enum\AddressStatusEnum;
use App\Enum\AddressTypeEnum;
use App\Enum\DeliveryStatusEnum;
use App\Enum\MealPlanStatusEnum;
use App\Enum\RoleNamesEnum;
use App\Http\Helper\Helper;

use App\Models\DeliverySlot;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Modules\BusinessService\Entities\CustomerAddress;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\DeliverySlotInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\UserRoleInterface;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Modules\BusinessService\Interfaces\BranchInterface;
use Modules\BusinessService\Interfaces\BusinessCategoryInterface;
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;
use Modules\BusinessService\Interfaces\CustomerInterface;
use Modules\BusinessService\Interfaces\CustomerSecondaryNumberInterface;
use Modules\DeliveryService\Http\Exports\DeliveryTemplateClass;
use Modules\DeliveryService\Interfaces\DeliveryBatchInterface;
use Modules\DeliveryService\Interfaces\DeliveryInterface;
use Modules\DeliveryService\Interfaces\DeliveryTimelineInterface;
use Modules\DeliveryService\Interfaces\DeliveryTypeInterface;
use Modules\DeliveryService\Interfaces\MealPlanInterface;
use Modules\FleetService\Interfaces\DriverAreaInterface;
use Modules\FleetService\Interfaces\DriverInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Propaganistas\LaravelPhone\PhoneNumber;
use function PHPUnit\Framework\isEmpty;

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
    private $BusinessCategoryRepository;
    private $businessCustomerRepository;
    private $deliveryTypeRepository;
    private $deliveryRepository;
    private $helper;
    private $driverAreaRepository;
    private $driverRepository;
    private $deliveryBatchRepository;
    private $deliveryTimelineRepository;
    private $roleRepository;
    private $userRoleRepository;
    private $mealPlanRepository;


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
        BusinessCategoryInterface $businessCategoryRepository,
        BusinessCustomerInterface $businessCustomerRepository,
        DeliveryTypeInterface $deliveryTypeRepository,
        DeliveryInterface $deliveryRepository,
        DriverAreaInterface $driverAreaRepository,
        DriverInterface $driverRepository,
        DeliveryBatchInterface $deliveryBatchRepository,
        DeliveryTimelineInterface $deliveryTimelineRepository,
        RoleInterface $roleRepository,
        UserRoleInterface $userRoleRepository,
        MealPlanInterface $mealPlanRepository,
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
        $this->BusinessCategoryRepository = $businessCategoryRepository;
        $this->businessCustomerRepository = $businessCustomerRepository;
        $this->deliveryTypeRepository = $deliveryTypeRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->driverAreaRepository = $driverAreaRepository;
        $this->driverRepository = $driverRepository;
        $this->deliveryBatchRepository = $deliveryBatchRepository;
        $this->deliveryTimelineRepository = $deliveryTimelineRepository;
        $this->roleRepository = $roleRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->mealPlanRepository = $mealPlanRepository;
        $this->helper = $helper;
    }

    public function viewMealPlan()
    {
        $partner = $this->businessRepository->getActiveBusinesses();
        $business_customers = $this->businessCustomerRepository->get();
        $businesses = $this->businessRepository->getActiveBusinesses();
        $data = [
            'partners' => $partner,
            'business_customers' => $business_customers,
            'businesses' => $businesses,
        ];

        return view('deliveryservice::planner.plan_delivery', $data);
    }

    public function addMealPlan(Request $request)
    {

        $partner = $request->input('partner');
        $c_id = $request->input('customer');
        $branches = $this->branchRepository->getBusinessBranches($partner);
        $partner = $this->businessRepository->getActiveBusinesses(); //to show partners
        $other_customers = $this->businessCustomerRepository->get(); //for dropdown
        $business_customer = $this->businessCustomerRepository->getSingleBusinessCustomerWhere(['customer_id' => $c_id]);
        $product_type = $this->BusinessCategoryRepository->getBusinessCategory();
        $customer_addr = $this->customerAddressRepository->getCustomerAddresses($business_customer->customer_id);
        $data = [
            'partners' => $partner,
            'other_customers' => $other_customers,
            'product_type' => $product_type,
            'business_customer' => $business_customer,
            'customer_addresses' => $customer_addr,
            'branches' => $branches
        ];

        return view('deliveryservice::planner.add_plan_delivery', $data);
    }
    public function uploadMealPlan(Request $request)
    {
        $submittedData = request()->all(); // Get all input from the request
        // $date = $deliveryAddresses[0]; 
        $starting_date = $submittedData['starting_date'];
        $expiry_date = $submittedData['expiry_date'];
        $no_of_days = $submittedData['no_of_plan_days'];
        $skip_days = $submittedData['skip_days'];
        $customer_id = $submittedData['customer_id'];
        $business_id = $submittedData['business_id'];
        $included_dates = json_decode($submittedData['included_dates']);


        // $start_date = new DateTime::format('Y-m-d', $start_date);
        // $end_date = new DateTime($expiry_date);

        // Create a DateTime object from the string
        $start_date = new DateTime($starting_date);
        $end_date = new DateTime($expiry_date);


        // Format the date however you need
        // For example, to display it in 'Y-m-d H:i:s' format
        // dd($date->forma('Y-m-d H:i:s'), gettype($date->format('Y-m-d')));
        // $dateObject = DateTime::createFromFormat('Y-m-d', $starting_date);
        // if ($dateObject === false) {
        //     // Handle invalid date format
        //     dd("Invalid date format ", $starting_date, gettype($starting_date));
        // } else {
        //     $start_date = $dateObject->getTimestamp();
        //     $start_time = date('Y-m-d H:i:s', $start_date);
        //     dd($start_time);
        // }



        $start_date =  $start_date->format('Y-m-d');
        $end_date = $end_date->format('Y-m-d');

        // dd($start_date, $end_date, gettype($start_date), gettype($start_date));
        //customer id, business id
        //customer id from customer address and business ic can be get from branch id or business selected in view plan

        $meal_data = [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => MealPlanStatusEnum::ACTIVE->value,
            'skip_days' => json_encode($skip_days),
            'customer_id' => $customer_id,
            'business_id' => $business_id,

        ];
        try {
            DB::beginTransaction();
            $plan = $this->mealPlanRepository->create($meal_data);
            //save this meal object in meal model and get id of saved data
            // dd($deliveryAddresses, $request, $submittedData, $starting_date);
            foreach ($included_dates as $i => $date) {
                $customer = $this->customerAddressRepository->getCustomerAddressById($submittedData['delivery_address'][$i]);


                $delivery_data = [
                    'status' => DeliveryStatusEnum::UNASSIGNED->value,
                    'is_recurring' => false,
                    'payment_status' => false,
                    'is_sign_required' => false,
                    'is_notification_enabled' => $submittedData['notification'][$i],
                    'note' => $submittedData['notes'][$i],
                    'branch_id' => $submittedData['pickup_point'][$i],
                    'delivery_slot_id' => $submittedData['time_slot'][$i],
                    'delivery_type_id' => null,
                    'delivery_date' => $date,
                    'customer_id' => $customer->customer_id,
                    'area_id' => $customer->area_id,
                    'city_id' => $customer->city_id,
                    'state_id' => $customer->state_id,
                    'country_id' => $customer->country_id,
                    'meal_plan_id' => $plan->id
                ];

                $this->deliveryRepository->create($delivery_data);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return 'Delivery Data upload failed: ' . $e->getMessage();
        }
        // return view('deliveryservice::planner.add_plan_delivery');
        return redirect()->route('view_plan_delivery')->with("success", "Meal-Plan uploaded successfully");
    }


    public function getCustomersMealPlan($customer_id)
    {
        $customer_meal_plans = $this->mealPlanRepository->getCustomerMealPlans($customer_id);
        return response()->json($customer_meal_plans);
    }

    /**
     * Display a listing of the resource.
     */
    public function viewAllDeliveries()
    {
        return view('deliveryservice::deliveries.deliveries');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function test()
    {
        dd("hello");
    }

    public function viewUnassignedDeliveries()
    {
        return view('deliveryservice::deliveries.unassigned_deliveries');
    }

    public function uploadDeliveriesMultiple(Request $request)
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
            // $phone_number = new PhoneNumber($row['phone']);
            // $phone_number =  $phone_number->formatE164();
            $phone_number = $row['phone'];
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
            try {
                DB::beginTransaction();
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
                    $address_matching = $this->helper->addressDBStatus($deliveryAddress, $customer_addresses);
                    $this->businessCustomerRepository->create(customer_id: $customer->id, business_id: $request->business_id);
                } else {
                    $user = $this->userRepository->createUser([
                        'name' => $name,
                        'phone' => $phone_number,
                        'password' => Hash::make("1234abcd"),
                        'is_active' => true
                    ], false);
                    $role_id = $this->roleRepository->getRoleByName(RoleNamesEnum::CUSTOMER->value);
                    $this->userRoleRepository->createUserRole(userId: $user->id, roleId: $role_id->id);

                    $customer = $this->customerRepository->create(['user_id' => $user->id]);
                    $role_id = $this->roleRepository->getRoleByName(RoleNamesEnum::CUSTOMER->value);
                    $this->userRoleRepository->createUserRole(userId: $user->id, roleId: $role_id->id);
                    $this->businessCustomerRepository->create(customer_id: $customer->id, business_id: $request->business_id);
                }

                $delivery_type = $this->deliveryTypeRepository->getWhereFirst(['name' => $productType]);
                // $db_delivery_slot = $this->deliverySlotRepository->getDeliverySlotsByTimeAndCity($emiratesWithTime->start_time, $emiratesWithTime->end_time, $city->id);

                $finalized_address = '';



                $delivery_data = [
                    'status' => DeliveryStatusEnum::UNASSIGNED->value,
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
                        'address_status' => $new_address_coordinates ? AddressStatusEnum::COORDINATES_MANUAL_APPORVAL_REQUIRED->value : AddressStatusEnum::NO_COORDINATES->value,
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
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                // return 'Delivery Data upload failed: ' . $e->getMessage();
                return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
            }
        }

        if (count($conflicted_deliveries) == 0) {
            return redirect()->back()->with('success', 'Valid deliveries uploaded successfully.');
        } else {
            return view('deliveryservice::deliveries.conflicted_deliveries', ['conflicted_deliveries' => $conflicted_deliveries]);
        }


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


    public function generateAndDownloadDeliveryTemplate(Request $request)
    {
        $data = [];
        return Excel::download(new DeliveryTemplateClass($data, $request->get("total_deliveries")), 'delivery_template.xlsx');
    }

    public function uploadDeliveriesByExcel(Request $request)
    {

        // $businesses = $this->businessRepository->getActiveBusinesses();

        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|mimes:xlsx,xls,csv',
            'delivery_date' => 'required',
            'business_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

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
        $business_id = $request->business_id;

        $data = $this->helper->getExcelSheetData($file);

        // Create chunks of data with 10 rows each
        $chunks = array_chunk($data, 10);

        $header = $chunks[0][0];
        $header = array_map(fn ($v) => trim(str_replace([' ', '(', ')'], ['_', '', ''], strtolower(preg_replace('/\(([^)]+)\)/', '$1', $v))), '_'), $header);
        unset($chunks[0][0]);
        $batch = Bus::batch([])->dispatch();
        $conflicted_deliveries = [];
        foreach ($chunks as $key => $chunk) {
            try {
                DB::beginTransaction();

                if ($this->helper->headersMatch($header, $expected_headers)) {
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
                            $address_matching = $this->helper->addressDBStatus($sheet_address, $customer_addresses);
                            $this->businessCustomerRepository->create(customer_id: $customer->id, business_id: $request->business_id);
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

                        // dd($address_matching);
                        if ($address_matching == null || ($address_matching && $address_matching['status'] == 'MISSING')) {

                            // add new and get customer id
                            $new_address_coordinates = $this->helper->convertStringAddressToCoordinates($sheet_address);
                            $address_data = [
                                'address' => $sheet_address,
                                'address_type' => AddressTypeEnum::DEFAULT->value,
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
                return 'Data upload failed: ' . $e->getMessage();
            }
        }

        if (count($conflicted_deliveries) == 0) {
            return redirect()->back()->with('success', 'Valid deliveries uploaded successfully.');
        } else {
            return view('deliveryservice::deliveries.conflicted_deliveries', ['conflicted_deliveries' => $conflicted_deliveries]);
        }
        // return redirect()->back()->with('success', 'Valid deliveries uploaded successfully.');
        // return redirect()->route('deliveryservice::deliveries.upload_delivery')->with(['businesses' => $businesses]);
        // return view('deliveryservice::deliveries.upload_delivery', ['businesses' =>  $businesses]);

        // return view('deliveryservice::deliveries.upload_delivery', [
        //     'businesses' => $businesses,
        //     'conflicted_deliveries' => $conflicted_deliveries
        // ]);
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
                    'address_status' => $new_address_coordinates ? AddressStatusEnum::COORDINATES_MANUAL_APPORVAL_REQUIRED->value : AddressStatusEnum::NO_COORDINATES->value,
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




    //TODO::This function (getAddresses) will be moved to CustomerAddressController

    public function getAddresses(Request $request)
    {
        $selectedCustomer = $request->input('customer');
        // Retrieve delivery addresses for the selected customer
        $deliveryAddresses = CustomerAddress::where('customer', $selectedCustomer)->pluck('address');

        return response()->json(['deliveryAddresses' => $deliveryAddresses]);
    }


    public function uploadDeliveries()
    {
        $businesses = $this->businessRepository->getActiveBusinesses();
        $areas = $this->areaRepository->getAllAreas();
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
            // 'business' => $business
        ];
        return view('deliveryservice::deliveries.upload_delivery', $data);
    }

    // function viewAssignedDeliveries()
    // {
    //     $deliveries = $this->deliveryRepository->getDeliveriesByStatus('ASSIGNED');
    //     $drivers = $this->driverRepository->getDetailDrivers();
    //     $data = ['deliveries' => $deliveries, 'drivers' => $drivers];
    //     return view('deliveryservice::deliveries.assigned_deliveries', $data);
    // }
    public function viewAssignedDeliveries()
    {
        $time_slot = $this->deliverySlotRepository->getAllDeliverySlots()->toArray();
        $businesses = $this->businessRepository->getActiveBusinesses();
        $deliveries = $this->deliveryRepository->getDeliveriesByStatus(DeliveryStatusEnum::ASSIGNED->value);
        $emirate = $this->cityRepository->getActiveCities();
        // Sort the time slots based on start_time
        usort($time_slot, function ($a, $b) {
            return strcmp($a['start_time'], $b['start_time']);
        });

        // dd($deliveries);
        foreach ($deliveries as $delivery) {
            $customerAddress = $delivery->customerAddress;
            // Step 1: Find a driver that matches the delivery area and has deuty timing eligilable for that slot
            $drivers = $this->driverRepository->getDriversbyAreaID($customerAddress->area_id, $delivery->deliverySlot->start_time, $delivery->deliverySlot->end_time);
            $delivery->setAttribute('suggested_drivers', $drivers);
        }
        $drivers = $this->driverRepository->getDetailDrivers();
        $data = [
            'deliveries' => $deliveries,
            'drivers' => $drivers,
            'partners' => $businesses,
            'time_slot' => $time_slot,
            'emirate' => $emirate
        ];
        return view('deliveryservice::deliveries.assigned_delivery', $data);
    }

    public function deliveryTimeline(Request $request, $id)
    {
        $delivery_timeline = $this->deliveryTimelineRepository->getDeliveryTimeline($id);
        return view('deliveryservice::deliveries.delivery_timeline', ["delivery_timeline" => $delivery_timeline]);
    }

    // ------------------------------------- SUGGESTED DRIVER-----------------------

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

    // foreach ($deliveries as $delivery) {
    //     echo ('Delivery : ' . $delivery->deliverySlot->start_time . '-' . $delivery->deliverySlot->end_time . 'area : ' . $delivery->customerAddress->area->name);
    //     echo "<br><br>";
    //     foreach ($delivery->suggested_drivers as $driver) {
    //         echo ('Driver : ' . $driver->employee->first_name . ' - ' . $driver->employee->duty_start_time . '-' . $driver->employee->duty_end_time . ' - ' . $driver->areas->pluck('name'));
    //     }

    //     echo "<br>next delivery<br>";
    // }
    function unassignedDeliveries()
    {

        $time_slot = $this->deliverySlotRepository->getAllDeliverySlots()->toArray();
        $businesses = $this->businessRepository->getActiveBusinesses();
        $deliveries = $this->deliveryRepository->getDeliveriesByStatus(DeliveryStatusEnum::UNASSIGNED->value);
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


        return view('deliveryservice::deliveries.unassigned_deliveries', $data);
    }



    function viewCompletedDeliveries()
    {
        $deliveries = $this->deliveryRepository->getDeliveriesByStatus('DELIVERED');
        $drivers = $this->driverRepository->getDetailDrivers();
        $data = ['deliveries' => $deliveries, 'drivers' => $drivers];
        return view('deliveryservice::deliveries.completed_deliveries', $data);
    }

    public function view_labels()
    {
        $path = 'media/bags/qrcodes/' . time() . '.svg';

        // QrCode::size(400)->generate($bag->id, $path);
    }

    public function getBusinessBranches($id)
    {
        $branches = $this->branchRepository->getBusinessBranches($id);
        $response = [
            'branches' => $branches
        ];
        return response()->json($response);
    }

    public function printLabel(Request $request)
    {
        $selectedDeliveryIds = explode(',', $request->input('selected_deliveries', ''));

        // Fetch the corresponding delivery data based on the IDs
        $selectedDeliveries = $this->deliveryRepository->getDeliveriesByIds($selectedDeliveryIds);
        foreach ($selectedDeliveries as $key => $delivery) {
            // --- Create a QR if no QR is ccreated for delivery yet 
            if ($delivery->qr_code == null) {
                $directory = 'media/deliveries/qrcodes/';
                if (!file_exists($directory)) {
                    // Create the directory if it doesn't exist
                    mkdir($directory, 0777, true);
                }
                echo ('<pre> address :' . var_dump($delivery->id) . ' </pre>');

                $qr_data = json_encode([
                    'delivery_id' => $delivery->id,
                    'type' => 'delivery',
                ]);
                echo ('<pre> address :' . var_dump($qr_data) . ' </pre>');

                $path = $directory . time() . '.svg';
                QrCode::size(400)->generate($qr_data, $path);
                $this->deliveryRepository->updateDeliveryQR($delivery->id, ['qr_code' => $path]);
            }
        }

        return view('deliveryservice::deliveries.print_label', ['selectedDeliveries' => $selectedDeliveries]);
    }

    public function assignDeliveriesToDriver(Request $request)
    {
        try {
            // --------------- GETTING DELIVERIES AND DRIVER TO ASSIGN-------------
            $driver_id = $request->get("driver_id");
            // $deliveries = explode(',', $request->get("selected_delivery_ids"));
            $deliveries = $request->get("selected_delivery_ids");

            // -------------------- CREATING NEW BATCH FOR DELIVERY BASED ON DRIVER id-----------
            $batch = $this->deliveryBatchRepository->getActiveDeliveryBatchByDriver($driver_id);

            // ---------------------ASSIGNING DELIVERIES TO BATCH -------------------------
            $this->deliveryRepository->assignDeliveryBatch($batch->id, $deliveries);
            return response()->json(['success' => 'Deliveries Assigned Successfully', 'redirect_url' => route('unassigned_deliveries')]);
        } catch (Exception $exception) {
            dd($exception);
        }
    }

    // public function viewMealPlan()
    // {
    //     $businesses = $this->businessRepository->getActiveBusinesses();
    //     return view('deliveryservice::planner.plan_delivery', ['businesses' => $businesses]);
    // }

    public function addCustomerToPlanView()
    {
        $businesses = $this->businessRepository->getActiveBusinesses();
        return view('deliveryservice::planner.add_customer_to meal_plan', ['businesses' => $businesses]);
    }
}
