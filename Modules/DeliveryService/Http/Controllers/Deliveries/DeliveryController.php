<?php

namespace Modules\DeliveryService\Http\Controllers\Deliveries;

use App\Enum\AddressStatusEnum;
use App\Enum\AddressTypeEnum;
use App\Enum\BusinessStatusEnum;
use App\Enum\DeliveryStatusEnum;
use App\Enum\MealPlanStatusEnum;
use App\Enum\RoleNamesEnum;
use App\Exports\CustomExportExcel;
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
use App\Jobs\OldDBTransferJob;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Modules\BusinessService\Entities\BusinessCustomer;
use Modules\BusinessService\Interfaces\BranchInterface;
use Modules\BusinessService\Interfaces\BusinessCategoryInterface;
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\BusinessService\Interfaces\BusinessUserInterface;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;
use Modules\BusinessService\Interfaces\CustomerInterface;
use Modules\BusinessService\Interfaces\CustomerSecondaryNumberInterface;
use Modules\BusinessService\Interfaces\SpecialInstructionInterface;
use Modules\DeliveryService\Http\Exports\DeliveryTemplateClass;
use Modules\DeliveryService\Interfaces\DeliveryBatchInterface;
use Modules\DeliveryService\Interfaces\DeliveryInterface;
use Modules\DeliveryService\Interfaces\DeliveryTimelineInterface;
use Modules\DeliveryService\Interfaces\DeliveryTypeInterface;
use Modules\DeliveryService\Interfaces\MealPlanInterface;
use Modules\FleetService\Interfaces\DriverAreaInterface;
use Modules\FleetService\Interfaces\DriverInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
    private $BusinessCategoryRepository;
    private $businessCustomerRepository;
    private $deliveryTypeRepository;
    private $deliveryRepository;
    private $helper;
    private $driverAreaRepository;
    private $driverRepository;
    private $deliveryBatchRepository;
    private $deliveryTimelineRepository;
    private $userRoleRepository;
    private $mealPlanRepository;
    private $businessUserRepository;
    private $roleRepository;
    private $businessRepository;
    private $branchRepository;
    private $specialInstructionRepository;

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
        BusinessUserInterface $businessUserRepository,
        SpecialInstructionInterface $specialInstructionRepository,
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
        $this->businessUserRepository = $businessUserRepository;
        $this->specialInstructionRepository = $specialInstructionRepository;
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


    public function viewUnassignedDeliveries()
    {
        return view('deliveryservice::deliveries.unassigned_deliveries');
    }

    public function uploadDeliveriesMultiple(Request $request)
    {

        // $request->validate([
        //     'kt_docs_repeater_advanced.*.delivery_name' => 'required|string|max:255',
        //     'kt_docs_repeater_advanced.*.phone' => 'required',
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
        //     'kt_docs_repeater_advanced.*.phone.required' => 'Phone number is required',
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
            $phone_number = $this->helper->formatPhoneNumber($row['phone']);
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
                        $phone_number = $this->helper->formatPhoneNumber($row['phone']);


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
                        $customer = $this->customerRepository->customerWithMatchingPhoneNoInUsers($phone_number);
                        if (!$customer && ($row['email_optional'] != '' || $row['email_optional'] != null)) {
                            $this->customerRepository->customerWithMatchingEmailInUsers($row['email_optional']);
                        }
                        $customer_addresses = '';
                        $address_matching = null;

                        // --- If customer phone already exist in priamry list 
                        if ($customer) {
                            // $customer_with_sec_phon =  $this->customerRepository->customerWithMatchingPhoneNoInSecondaryNumbers($phone_number); // Will need for dealing with secondary numbers
                            $customer_addresses = $this->customerAddressRepository->getCustomerCityAddresses($customer->id, $city->id);
                            $address_matching = $this->helper->addressDBStatus($sheet_address, $customer_addresses);
                            $this->businessCustomerRepository->create(customer_id: $customer->id, business_id: $request->business_id);
                        } else {
                            $user = $this->userRepository->createUser([
                                'name' => $row['full_name'],
                                'email' => $row['email_optional'] ?? null,
                                'phone' => $phone_number ?? null,
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





    public function testUploadDB(Request $request)
    {
        ini_set('max_execution_time', 30000);
        // =================== M E T H O D  - 1
        $file = $request->file('excel_file');
        // Store the file temporarily
        // Store the file temporarily
        // $excelFilePath = $file->storeAs('temp', 'original_filename.xlsx');

        // Pass the file path when dispatching the job
        // OldDBTransferJob::dispatch($file);
        $data = $this->helper->getExcelSheetData($file);
        // Create chunks of data with 10 rows each
        $chunks = array_chunk($data, 10);

        $header = $chunks[0][0];
        // 0 => "id"
        // 1 => "full_name"
        // 2 => "email"
        // 3 => "phone"
        // 4 => "password_partner"
        // 5 => "plain_password"
        // 6 => "address"
        // 7 => "created_dt"
        $header = array_map(fn ($v) => trim(str_replace([' ', '(', ')'], ['_', '', ''], strtolower(preg_replace('/\(([^)]+)\)/', '$1', $v))), '_'), $header);
        unset($chunks[0][0]);
        $num_freq = [];
        $faulted_records = [];
        try {
            DB::beginTransaction();
            $addition_count = 0;
            foreach ($chunks as $key => $chunk) {
                foreach ($chunk as  $row) {
                    echo "<script>window.scrollTo(0, document.body.scrollHeight);</script>";

                    $row = array_combine($header, $row);

                    $phone_number = $this->helper->formatPhoneNumber($row['phone']);

                    $db_user =  $this->userRepository->getSingleUserWhere(['name' => $row['full_name'], 'phone' => $phone_number,]);

                    if ($db_user) {
                        echo "<br> =============== S K I P P I N G " . json_encode($db_user) . "====================== <br>";
                        echo "<br> =============== S K I P P I N G " . json_encode($row) . "====================== <br>";
                    } elseif (array_key_exists($phone_number, $num_freq)) {
                        $num_freq[$phone_number]++;
                    } else {
                        $addition_count++;
                        $num_freq[$phone_number] = 1;
                        // echo "<br><br>" . var_dump($db_location_ids), PHP_EOL;
                        $user =  $this->userRepository->getSingleUserWhere(['phone' => $phone_number]);
                        if (!$user) {
                            $user =  $this->userRepository->createUser([
                                'name' => $row['full_name'],
                                'email' => $row['email'] == "" ? null : $row['email'],
                                'phone' => $phone_number == "" ? null : $phone_number,
                                'password' => Hash::make($row['password_partner']),
                            ], false);
                        }

                        echo "<br> ===============user " . json_encode($user) . "====================== <br>";


                        $role_id = $this->roleRepository->getRoleByName(RoleNamesEnum::BUSINESS_ADMIN->value);
                        $this->userRoleRepository->createUserRole(userId: $user->id, roleId: $role_id->id);

                        $business =  $this->businessRepository->createBusiness(
                            name: $row['full_name'],
                            business_category_id: '984584e4-3579-sde3-a380-363ee669ad42',
                            admin: $user->id,
                            status: BusinessStatusEnum::APPROVED->value
                        );
                        echo "<br> ===============business " . json_encode($business) . "====================== <br>";

                        $business_user = $this->businessUserRepository->createBusinessUser(
                            user_id: $user->id,
                            business_id: $business->id
                        );
                        echo "<br> ===============business_user " . json_encode($business_user) . "====================== <br>";
                        // ========================== A D D R E S S
                        $address_xy = null;
                        if (strtolower($row['address']) == 'dubai') {
                            $address_xy =  (object) ['latitude' => '25.3585607', 'longitude' => '55.5645216'];
                        } elseif (strtolower($row['address']) == 'abu dhabi') {
                            $address_xy =  (object) ['latitude' => '24.621895', 'longitude' => '54.8509598'];
                        } else {
                            $address_xy = $this->helper->convertStringAddressToCoordinates($row['address']);
                        }

                        if ($address_xy == null) {
                            // $row['reason'] = "No valid cordinates obtained for the address";
                            // array_push($faulted_records, $row);

                            $branch =   $this->branchRepository->createBranch(
                                name: "Main branch",
                                phone: $phone_number,
                                address: $row['address'],
                                business_id: $business->id,
                                is_main_branch: true,
                                active_status: true,
                            );
                        } else {
                            $address =   $this->helper->getLocationFromCoordinates($address_xy->latitude, $address_xy->longitude);
                            echo "<br><br> ===================================== <br>";
                            echo "<br> R O W : " . $row['full_name'] . " and address_xy" . json_encode($address_xy) . " and address " . json_encode($address) . "<br>";
                            echo "<br> ===================================== <br>";
                            echo var_dump($address), PHP_EOL;

                            $db_location_ids = $this->helper->findDBLocationsWithNames(
                                $address['country'],
                                $address['state'],
                                $address['city'],
                                $address['area'],
                            );
                            echo "<br> ===============db_location_ids " . json_encode($db_location_ids) . "====================== <br>";

                            if ($db_location_ids['country_id'] == "" || $db_location_ids['state_id'] == "" || $db_location_ids['city_id'] == "") {
                                array_push($faulted_records, $row);
                            } else {

                                $branch =   $this->branchRepository->createBranch(
                                    name: "Main branch",
                                    phone: $phone_number,
                                    address: $row['address'],
                                    country_id: $db_location_ids['country_id'],
                                    state_id: $db_location_ids['state_id'] == "" ? null : $db_location_ids['state_id'],
                                    city_id: $db_location_ids['city_id'] == "" ? null : $db_location_ids['city_id'],
                                    area_id: $db_location_ids['area_id'] == "" ? null : $db_location_ids['area_id'],
                                    business_id: $business->id,
                                    latitude: $address_xy->latitude ?? null,
                                    longitude: $address_xy->longitude ?? null,
                                    is_main_branch: true,
                                    active_status: true,
                                );
                                echo "<br> ===============branch " . json_encode($branch) . "====================== <br>";

                                echo "<br> ===================================== <br>";
                                // echo "<br> A D D E D: " . $row['full_name'] . " and Branch ID" . $branch->id . " <br>";
                                echo "<br> ===================================== <br><br>";
                            }
                        }
                    }
                    flush();
                }
                echo "<br><br> ================ Count: " . $addition_count . " Key:" . $key . " ===================== <br>";
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return 'Data upload failed: ' . $e->getMessage();
        }

        echo "<br><br>" .    print_r($faulted_records) . "<br>";
        arsort($num_freq);
        $export = new CustomExportExcel($faulted_records);

        // Generate and download the Excel file for each iteration
        Excel::download($export, 'file_name.xlsx');

        dd($num_freq);


        // =================== M E T H O D  - 2

        $businesses = array(
            0 =>
            array(
                'id' => 1,
                'full_name' => 'full_name',
                'email' => 'email',
                'phone' => 'phone',
                'Password_partner' => 'Password_partner',
                'plain_password' => 'plain_password',
                'address' => 'address',
                'created_dt' => 'created_dt',
            ),
            1 =>
            array(
                'id' => 30,
                'full_name' => 'PIR ABID SHAH',
                'email' => 'pocketappsdelivetudio@gmail.com',
                'phone' => '971527274271',
                'Password_partner' => '',
                'plain_password' => '',
                'address' => 'RED RESIDENCE, 1401, SPORTS CITY, Other',
                'created_dt' => '10/29/2018 22:43',
            ),
            2 =>
            array(
                'id' => 43,
                'full_name' => 'SUPERMEALS',
                'email' => 'kickass@supermealsuae.com',
                'phone' => '971555225667',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Motor City  New Bridge hill 2  Apartment 202  Dubai(OTHER)',
                'created_dt' => '10/30/2018 19:03',
            ),
            3 =>
            array(
                'id' => 44,
                'full_name' => 'PURA',
                'email' => 'mona@pura.ae',
                'phone' => '971567354912',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Al Quoz',
                'created_dt' => '10/30/2018 19:07',
            ),
            4 =>
            array(
                'id' => 226,
                'full_name' => 'PLANT POWER',
                'email' => 'Plantpower@logx.com',
                'phone' => '971506983722',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL QOUZ4',
                'created_dt' => '11/1/2018 21:02',
            ),
            5 =>
            array(
                'id' => 232,
                'full_name' => 'FITNESS FEEDZ',
                'email' => 'FitnessFeedz@foodiebrands.com',
                'phone' => '971529101282',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '11/1/2018 21:26',
            ),
            6 =>
            array(
                'id' => 240,
                'full_name' => 'REVIVRE LABS',
                'email' => 'Bruno@revivre-labs.com',
                'phone' => '971565484397',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '11/1/2018 21:39',
            ),
            7 =>
            array(
                'id' => 263,
                'full_name' => 'KETO LIFE',
                'email' => 'keto@logx.com',
                'phone' => '971566734640',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'ABU DHABI',
                'created_dt' => '11/2/2018 20:50',
            ),
            8 =>
            array(
                'id' => 455,
                'full_name' => 'ATHLETES KITCHEN',
                'email' => 'athleteskitchenuae@gmail.com',
                'phone' => '971506558282',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'al warqa',
                'created_dt' => '11/3/2018 15:02',
            ),
            9 =>
            array(
                'id' => 536,
                'full_name' => 'SMITH ST. PALEO',
                'email' => 'hello@smithstpaleo.com',
                'phone' => '971558916106',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL QOUZ 1',
                'created_dt' => '11/7/2018 7:50',
            ),
            10 =>
            array(
                'id' => 791,
                'full_name' => 'SLICES CATERING SERVICES LLC',
                'email' => 'paul@slices.ae',
                'phone' => '971525063027',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL QOUZ4',
                'created_dt' => '11/14/2018 19:57',
            ),
            11 =>
            array(
                'id' => 1331,
                'full_name' => 'EAT CLEAN LLC',
                'email' => 'info@eatcleanme.com',
                'phone' => '971504289908',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '11/29/2018 13:08',
            ),
            12 =>
            array(
                'id' => 1341,
                'full_name' => 'Aleix Garcia  3',
                'email' => 'moazam27@gmail.com',
                'phone' => '971111111111',
                'Password_partner' => '',
                'plain_password' => '',
                'address' => 'Sama Tower, 2104, Sheikh Zayed Road Sheikh Zayed Road, Sheikh Zayed Road',
                'created_dt' => '12/2/2018 1:29',
            ),
            13 =>
            array(
                'id' => 2243,
                'full_name' => 'TEST PARTNER',
                'email' => 'sami@thelogx.com',
                'phone' => '971-147852369',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '2/15/2019 15:28',
            ),
            14 =>
            array(
                'id' => 2889,
                'full_name' => 'PROTEIN HOUSE WARQA',
                'email' => 'Dunia@fithub.ae',
                'phone' => '971509001234',
                'Password_partner' => 'Protein',
                'plain_password' => '',
                'address' => 'AL WARQA MALL.',
                'created_dt' => '2/17/2019 18:35',
            ),
            15 =>
            array(
                'id' => 3484,
                'full_name' => 'COLOUR MY PLATE',
                'email' => 'marryjoyperez02@gmail.com',
                'phone' => '971509351013',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'VOLANTE TOWER',
                'created_dt' => '2/28/2019 11:59',
            ),
            16 =>
            array(
                'id' => 6677,
                'full_name' => 'EAT CONSCIOUS',
                'email' => 'cc@eatconscious.ae',
                'phone' => '971552500905',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL QOUZ',
                'created_dt' => '6/22/2019 10:25',
            ),
            17 =>
            array(
                'id' => 7018,
                'full_name' => 'Moazam',
                'email' => ' ',
                'phone' => '923310423657',
                'Password_partner' => '',
                'plain_password' => '',
                'address' => 'Lahore',
                'created_dt' => '6/24/2019 16:41',
            ),
            18 =>
            array(
                'id' => 7032,
                'full_name' => 'Rana Touqeer Attique',
                'email' => 'touqeerattiq@gmail.com',
                'phone' => '971123456789',
                'Password_partner' => '',
                'plain_password' => '',
                'address' => '181 Kamran Block Allama Iqbal Town',
                'created_dt' => '6/25/2019 16:09',
            ),
            19 =>
            array(
                'id' => 7035,
                'full_name' => 'test',
                'email' => ' ',
                'phone' => '971550087976',
                'Password_partner' => '',
                'plain_password' => '',
                'address' => 'Lahore',
                'created_dt' => '6/25/2019 18:09',
            ),
            20 =>
            array(
                'id' => 7550,
                'full_name' => 'SLICES CATERING',
                'email' => 'cpuslices@gmail.com',
                'phone' => '971563659913',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL QOUZ',
                'created_dt' => '7/15/2019 10:57',
            ),
            21 =>
            array(
                'id' => 8315,
                'full_name' => 'Slices Cash Collection',
                'email' => 'accounts@thelogx.com',
                'phone' => '971549986424',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Barsha 1',
                'created_dt' => '8/20/2019 17:20',
            ),
            22 =>
            array(
                'id' => 8957,
                'full_name' => 'KETO BY FOXXY',
                'email' => 'foxxy@gmail.com',
                'phone' => '971589996460',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '9/4/2019 9:32',
            ),
            23 =>
            array(
                'id' => 10294,
                'full_name' => 'GOURMET GRAND GROCER',
                'email' => 'gxthomas@grandgourmetgrocer.com',
                'phone' => '971555440458',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'PALM JUMEIRAH',
                'created_dt' => '10/7/2019 18:30',
            ),
            24 =>
            array(
                'id' => 10537,
                'full_name' => 'ALOFT HOTEL',
                'email' => 'Midhun.Dharmarajan@marriott.com',
                'phone' => '971874847482',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '10/14/2019 13:54',
            ),
            25 =>
            array(
                'id' => 10804,
                'full_name' => 'NOURISHING DUBAI',
                'email' => 'jeff@nourishingdubai.com',
                'phone' => '971505387133',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '10/21/2019 13:11',
            ),
            26 =>
            array(
                'id' => 11024,
                'full_name' => 'BEAST MODE NU TRITION',
                'email' => 'ashlynn@beast-mode-nu trition.com ',
                'phone' => '971528936660',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Room 304 Hilton double tree Jbr Dubai   Other  Dubai(Jumeirah Beach Residence)',
                'created_dt' => '10/28/2019 13:48',
            ),
            27 =>
            array(
                'id' => 12022,
                'full_name' => 'SNACK STUDIO',
                'email' => 'snackstudio@gmail.com',
                'phone' => '971583124404',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Foodie Brands',
                'created_dt' => '11/18/2019 11:47',
            ),
            28 =>
            array(
                'id' => 12803,
                'full_name' => 'ESSENTIALLY',
                'email' => 'kitchen@essentially.ae',
                'phone' => '557563207',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Al Quoz 3',
                'created_dt' => '',
            ),
            29 =>
            array(
                'id' => 13287,
                'full_name' => 'HEALTHY TEDDY',
                'email' => 'moe@healthyteddy.net',
                'phone' => '971-566652909',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            30 =>
            array(
                'id' => 14689,
                'full_name' => 'FITNESS KITCHEN',
                'email' => 'thefitnesskitchenme@gmail.com',
                'phone' => '971544295924',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'AL QOUZ 1',
                'created_dt' => '',
            ),
            31 =>
            array(
                'id' => 14695,
                'full_name' => 'HACKED KITCHEN DMCC',
                'email' => 'mujahid_islam@hackedkitchen.com',
                'phone' => '971559933603',
                'Password_partner' => 'HK@2020',
                'plain_password' => 'HK@2020',
                'address' => 'JLT  Cluster C  Shop C5-04  Dubai',
                'created_dt' => '',
            ),
            32 =>
            array(
                'id' => 14812,
                'full_name' => 'KETO HUB DMCC',
                'email' => 'info@ketohub.ae',
                'phone' => '971505205542',
                'Password_partner' => 'Logxlife1234',
                'plain_password' => '',
                'address' => 'DMCC 740745  and Address Unit No: 2237  DMCC Business Centre  Level No. 1  Jewellery & Gemplex 3  Dubai',
                'created_dt' => '',
            ),
            33 =>
            array(
                'id' => 16089,
                'full_name' => 'MR BAKER',
                'email' => 'ayesha.attique.work@gmail.com',
                'phone' => '9718372829375',
                'Password_partner' => '12345',
                'plain_password' => '',
                'address' => 'Test_partner Address',
                'created_dt' => '',
            ),
            34 =>
            array(
                'id' => 17478,
                'full_name' => 'MELANGE',
                'email' => 'hi@melangeme.com',
                'phone' => '971526349676',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Dubai ',
                'created_dt' => '',
            ),
            35 =>
            array(
                'id' => 17573,
                'full_name' => 'Shaheen M',
                'email' => 'info@wandersons.ae',
                'phone' => '971554554441',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Villa 9 -9 31 A St - Garhoud - Dubai-, Dubai(Al Garhoud)',
                'created_dt' => '',
            ),
            36 =>
            array(
                'id' => 18084,
                'full_name' => 'ROSELEAF CAFE',
                'email' => 'meri@roseleafcafe.com',
                'phone' => '971506588766',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            37 =>
            array(
                'id' => 19212,
                'full_name' => 'KETO BY FOXXY - MEAL PLAN ',
                'email' => 'KetoByFoxxy@logx.com',
                'phone' => '971506983722',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL QOUZ4',
                'created_dt' => '',
            ),
            38 =>
            array(
                'id' => 19218,
                'full_name' => 'THE COOKIE BANDITS',
                'email' => 'b.javier@foodiebrands.com',
                'phone' => '971506983722',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL QOUZ4',
                'created_dt' => '',
            ),
            39 =>
            array(
                'id' => 19531,
                'full_name' => 'COLD PRESSED JUICES',
                'email' => 's.katende@foodiebrands.com',
                'phone' => '971506983722',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL QOUZ4',
                'created_dt' => '',
            ),
            40 =>
            array(
                'id' => 19928,
                'full_name' => 'MILK BAR',
                'email' => 'Milkbakery.ae@gmail.com',
                'phone' => '971557744441',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            41 =>
            array(
                'id' => 20470,
                'full_name' => 'KETOBITES',
                'email' => 'Amjad@delibitecatering.com',
                'phone' => '971506560528',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            42 =>
            array(
                'id' => 20846,
                'full_name' => 'NIGHTJAR',
                'email' => 'accounts@nightjar.coffee',
                'phone' => '971559153706',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Al Quoz 1',
                'created_dt' => '',
            ),
            43 =>
            array(
                'id' => 20916,
                'full_name' => 'SOIL STORE',
                'email' => 'alseef@soilstore.com',
                'phone' => '971501119594',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Abu Dhabi',
                'created_dt' => '',
            ),
            44 =>
            array(
                'id' => 21263,
                'full_name' => 'MUSCLEFUEL',
                'email' => 'admin@musclefueluae.com',
                'phone' => '971564131115',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Abu dhabi',
                'created_dt' => '',
            ),
            45 =>
            array(
                'id' => 21649,
                'full_name' => 'PROTEIN BAKESHOP',
                'email' => 'hello@theproteinbakeshop.com',
                'phone' => '971529455227',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            46 =>
            array(
                'id' => 21750,
                'full_name' => 'ITALIAN CAKE & BAKE',
                'email' => 'melodygeorge@hotmail.com',
                'phone' => '971 504508798',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'JLT',
                'created_dt' => '',
            ),
            47 =>
            array(
                'id' => 22017,
                'full_name' => 'BUTTERSCOTCH BAKERY',
                'email' => 'may@butterscotchbakery.com',
                'phone' => '971506685238',
                'Password_partner' => 'Logxlife1234',
                'plain_password' => '',
                'address' => 'Abu Dhabi',
                'created_dt' => '',
            ),
            48 =>
            array(
                'id' => 23074,
                'full_name' => 'ELEGANT GIFT WRAPPING',
                'email' => 'katrina@alrais.ae',
                'phone' => '971505798612',
                'Password_partner' => 'Logxlife1234',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            49 =>
            array(
                'id' => 23487,
                'full_name' => 'WASLA',
                'email' => 'alreem@waslanow.com',
                'phone' => '971505611066',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'MIZHAR ',
                'created_dt' => '',
            ),
            50 =>
            array(
                'id' => 23541,
                'full_name' => 'NUTRIBEAST',
                'email' => 'leon@kitchenkollectiv.com',
                'phone' => '971505522463',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL QUOZ 4',
                'created_dt' => '',
            ),
            51 =>
            array(
                'id' => 23756,
                'full_name' => 'STASH BEAUTY LTD',
                'email' => 'stashwithlove@outlook.com',
                'phone' => '971504425269',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            52 =>
            array(
                'id' => 23844,
                'full_name' => 'KETO FRESH',
                'email' => 'ala.jebrini@gmail.com',
                'phone' => '971529256000',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Al Barsha',
                'created_dt' => '',
            ),
            53 =>
            array(
                'id' => 23927,
                'full_name' => 'RAWKURE LLC',
                'email' => 'rawkuremealplans@foodiebrands.com',
                'phone' => '9715 6017881',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL QOUZ4',
                'created_dt' => '',
            ),
            54 =>
            array(
                'id' => 25020,
                'full_name' => 'NUTRI ',
                'email' => 'nutri@thelogx.com',
                'phone' => '971504066993',
                'Password_partner' => 'Logxlife1234',
                'plain_password' => '',
                'address' => 'Abu Dhabi',
                'created_dt' => '',
            ),
            55 =>
            array(
                'id' => 26911,
                'full_name' => 'THE BEET BOX',
                'email' => 'people@thebeetbox.me',
                'phone' => '971553647300',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            56 =>
            array(
                'id' => 27341,
                'full_name' => 'WOROOD INTRAFLORA',
                'email' => 'hetal@worood.com',
                'phone' => '971561737335',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Mall Of The Emirates',
                'created_dt' => '',
            ),
            57 =>
            array(
                'id' => 27563,
                'full_name' => 'Live Right DMCC (Eat Right)',
                'email' => 'vh@theliveright.com',
                'phone' => '971551903770',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'UAE',
                'created_dt' => '',
            ),
            58 =>
            array(
                'id' => 27936,
                'full_name' => 'EAT WELL',
                'email' => 'a.helmy@dubaieatwell.com',
                'phone' => '971586851226',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            59 =>
            array(
                'id' => 28153,
                'full_name' => 'SAHTEIN',
                'email' => 'Dokhanchi@sahtein.ae',
                'phone' => '971547964111',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            60 =>
            array(
                'id' => 28286,
                'full_name' => 'ZERO FAT',
                'email' => 'zerofat@logx.com',
                'phone' => '971502269880',
                'Password_partner' => 'r4ldgrpt',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            61 =>
            array(
                'id' => 30329,
                'full_name' => 'test_partner_for_new_release',
                'email' => 'hello@thelogx.com',
                'phone' => '971098676768',
                'Password_partner' => '12345',
                'plain_password' => '',
                'address' => 'Test_partner Address for new',
                'created_dt' => '',
            ),
            62 =>
            array(
                'id' => 32994,
                'full_name' => 'THE RAW PLACE ',
                'email' => 'hashir@therawplace.com',
                'phone' => '971508943408',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'AL QOUZ',
                'created_dt' => '',
            ),
            63 =>
            array(
                'id' => 33589,
                'full_name' => 'THE CYCLE HUB',
                'email' => 'frane@thecyclehub.com',
                'phone' => '971545205840',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Unit 6B Dubai Autodrome Retail Plaza - Motor City - Dubai',
                'created_dt' => '',
            ),
            64 =>
            array(
                'id' => 33906,
                'full_name' => 'LOGX Transport LLC',
                'email' => 'logxdxb@gmail.com',
                'phone' => '971456456456',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            65 =>
            array(
                'id' => 34238,
                'full_name' => 'GROW UAE',
                'email' => 'Info@growuae.com',
                'phone' => '971507283823',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            66 =>
            array(
                'id' => 34768,
                'full_name' => 'BE-MORE KETO',
                'email' => 'operations@ketogoodiesdubai.com',
                'phone' => '971585896443',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            67 =>
            array(
                'id' => 36502,
                'full_name' => 'UTRITION',
                'email' => 'utrition@alahligroup.com',
                'phone' => '971543071312',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            68 =>
            array(
                'id' => 37535,
                'full_name' => 'Do Not Use - OLD Fitkult',
                'email' => 'jfares@fitkult.me',
                'phone' => '545448445',
                'Password_partner' => '78601',
                'plain_password' => '',
                'address' => 'ALQOUZ 3',
                'created_dt' => '',
            ),
            69 =>
            array(
                'id' => 38833,
                'full_name' => 'FITBITES',
                'email' => 'fitbites@thelogx.com',
                'phone' => '97152226910',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            70 =>
            array(
                'id' => 40062,
                'full_name' => 'Test Partner Ayesha Attique',
                'email' => 'atiqshazzia104@gmail.com',
                'phone' => '9713228009002',
                'Password_partner' => '12345',
                'plain_password' => '',
                'address' => 'Test street#2 Test Town',
                'created_dt' => '',
            ),
            71 =>
            array(
                'id' => 40194,
                'full_name' => 'HONEST BADGER FOODS',
                'email' => 'hello@honestbadgerfoods.com',
                'phone' => '971-502234981',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'AL QOUZ 3',
                'created_dt' => '',
            ),
            72 =>
            array(
                'id' => 40624,
                'full_name' => '77 VEGGIE',
                'email' => 'manish@77veggie.com',
                'phone' => '971-559851077',
                'Password_partner' => 'cancelled',
                'plain_password' => '',
                'address' => 'DIP DUBAI',
                'created_dt' => '',
            ),
            73 =>
            array(
                'id' => 41120,
                'full_name' => 'HOME MADE DUBAI',
                'email' => 'homemadedxb@foodiebrands.com',
                'phone' => '971585824714',
                'Password_partner' => 'Homemade2021',
                'plain_password' => '',
                'address' => 'ALQOUZ',
                'created_dt' => '',
            ),
            74 =>
            array(
                'id' => 41156,
                'full_name' => 'Wajabat',
                'email' => 'wajabat@gmail.com',
                'phone' => '971585232389',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'ABU DHABI',
                'created_dt' => '',
            ),
            75 =>
            array(
                'id' => 43004,
                'full_name' => 'KETO FOR LESS',
                'email' => 'KFL@THELOGX.COM',
                'phone' => '971543197214',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL QOUZ',
                'created_dt' => '',
            ),
            76 =>
            array(
                'id' => 43158,
                'full_name' => 'Cody Barrett',
                'email' => 'c.zablan@foodiebrands.com',
                'phone' => '971501522348',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => '22 Street Alquoz 3, Foodie Brands Catering Services, Dubai(OTHER)',
                'created_dt' => '',
            ),
            77 =>
            array(
                'id' => 44010,
                'full_name' => 'COLES',
                'email' => 'Coles@thelogx.com',
                'phone' => '971501521234',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'ABU DHABI',
                'created_dt' => '',
            ),
            78 =>
            array(
                'id' => 44061,
                'full_name' => 'Well emirates',
                'email' => 'wellemirates@thelogx.com',
                'phone' => '971520012345',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'ABU DHABI',
                'created_dt' => '',
            ),
            79 =>
            array(
                'id' => 44313,
                'full_name' => 'Klean',
                'email' => 'klean@thelogx.com',
                'phone' => '971520012345',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL Quoz 4',
                'created_dt' => '',
            ),
            80 =>
            array(
                'id' => 45305,
                'full_name' => 'MEALPLANS.AE',
                'email' => 'mealplan.ae@thelogx.com',
                'phone' => '971520012340',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Healthcare city',
                'created_dt' => '',
            ),
            81 =>
            array(
                'id' => 46044,
                'full_name' => 'VITAMIN V ',
                'email' => 'Vitaminv@thelogx.com',
                'phone' => '971520012345',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Khawaneej',
                'created_dt' => '',
            ),
            82 =>
            array(
                'id' => 46507,
                'full_name' => 'Testing ABC',
                'email' => 'shaziaattiq033@gmail.com',
                'phone' => '971399875391912',
                'Password_partner' => '12345',
                'plain_password' => '',
                'address' => 'Testing Address',
                'created_dt' => '',
            ),
            83 =>
            array(
                'id' => 47467,
                'full_name' => 'SAGE',
                'email' => 'sage@thelogx.com',
                'phone' => '971520012345',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Al Barsha 1',
                'created_dt' => '',
            ),
            84 =>
            array(
                'id' => 48007,
                'full_name' => 'iDiet',
                'email' => 'iDiet@foodiebrands.com',
                'phone' => '971547068130',
                'Password_partner' => 'idiet',
                'plain_password' => '',
                'address' => 'Al Quoz',
                'created_dt' => '',
            ),
            85 =>
            array(
                'id' => 48146,
                'full_name' => 'Pop Dubai',
                'email' => 'popdubai@foodiebrands.com',
                'phone' => '971520012389',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Al Quoz',
                'created_dt' => '',
            ),
            86 =>
            array(
                'id' => 49419,
                'full_name' => 'Springbok',
                'email' => 'Springbok@thelogx.com',
                'phone' => '971520012345',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Gorilla Kitchen',
                'created_dt' => '',
            ),
            87 =>
            array(
                'id' => 49804,
                'full_name' => 'Pear',
                'email' => 'pear@thelogx.com',
                'phone' => '971520012346',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Gorilla Kitchen',
                'created_dt' => '',
            ),
            88 =>
            array(
                'id' => 49847,
                'full_name' => 'Sahara Catering',
                'email' => 'saharacatering@thelogx.com',
                'phone' => '971520012346',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Barsha 1',
                'created_dt' => '',
            ),
            89 =>
            array(
                'id' => 52074,
                'full_name' => 'PROTEIN HOUSE AL WASL - Reem',
                'email' => 'Nourhanybarbar@gmail.com',
                'phone' => '971-222554681',
                'Password_partner' => '1234ABCD',
                'plain_password' => '',
                'address' => 'ALWASL',
                'created_dt' => '',
            ),
            90 =>
            array(
                'id' => 53018,
                'full_name' => 'EroeGo',
                'email' => 'EroeGo@thelogx.com',
                'phone' => '971520019874',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'ras al khor',
                'created_dt' => '',
            ),
            91 =>
            array(
                'id' => 53207,
                'full_name' => 'FITFOOD',
                'email' => 'fitfood@thelogx.com',
                'phone' => '971520011233',
                'Password_partner' => 'gv09m2of',
                'plain_password' => '',
                'address' => 'Be more keto',
                'created_dt' => '',
            ),
            92 =>
            array(
                'id' => 53524,
                'full_name' => 'POKE & CO',
                'email' => 'POKE@THELOGX.COM',
                'phone' => '971523760564',
                'Password_partner' => 'ttqnx85t',
                'plain_password' => '',
                'address' => 'JLT',
                'created_dt' => '',
            ),
            93 =>
            array(
                'id' => 53822,
                'full_name' => 'PROTEIN HOUSE ALMIZHAR',
                'email' => 'ph@fithub.ae',
                'phone' => '971507455933',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Dubai Mizhar',
                'created_dt' => '',
            ),
            94 =>
            array(
                'id' => 54329,
                'full_name' => 'Low Carb City',
                'email' => 'LowCarbCity@thelogx.com',
                'phone' => '971585896489',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            95 =>
            array(
                'id' => 54739,
                'full_name' => 'Haute Sauce',
                'email' => 'hautesauce@thelogx.com',
                'phone' => '971568839474',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            96 =>
            array(
                'id' => 54740,
                'full_name' => 'Health Road',
                'email' => 'healthroad@thelogx.com',
                'phone' => '971552097442',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            97 =>
            array(
                'id' => 55164,
                'full_name' => 'BASILIGO RESTAURANT LLC',
                'email' => 'basiligo@thelogx.com',
                'phone' => '971545180219',
                'Password_partner' => 'Fresh@2022',
                'plain_password' => 'Fresh@2022',
                'address' => 'ABU DHABI',
                'created_dt' => '',
            ),
            98 =>
            array(
                'id' => 55274,
                'full_name' => '8020 PREP',
                'email' => '8020@foodiebrands.com',
                'phone' => '971-562443199',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            99 =>
            array(
                'id' => 55457,
                'full_name' => 'KETO GOODIES',
                'email' => 'SOCIALMEDIA.KETOGOODIES@GMAIL.COM',
                'phone' => '971585896443',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'INTERNATIONAL CITY GREECE CLUSTER',
                'created_dt' => '',
            ),
            100 =>
            array(
                'id' => 55540,
                'full_name' => 'LoseWeight',
                'email' => 'loseweight@thelogx.com',
                'phone' => '9715451817947',
                'Password_partner' => 'Fresh@2022',
                'plain_password' => 'Fresh@2022',
                'address' => 'ABU DHABI',
                'created_dt' => '',
            ),
            101 =>
            array(
                'id' => 55941,
                'full_name' => 'Healthy Fresh',
                'email' => 'healthyfresh@thelogx.com',
                'phone' => '971551234789',
                'Password_partner' => 'Fresh@2022',
                'plain_password' => 'Fresh@2022',
                'address' => 'ABU DHABI',
                'created_dt' => '',
            ),
            102 =>
            array(
                'id' => 56266,
                'full_name' => 'Tasting Bay ',
                'email' => 'tastingbay@thelogx.com',
                'phone' => '971507055118',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            103 =>
            array(
                'id' => 59248,
                'full_name' => 'Freshly',
                'email' => 'freshly@thelogx.com',
                'phone' => '971551234789',
                'Password_partner' => 'Fresh@2022',
                'plain_password' => '',
                'address' => 'ras al khor',
                'created_dt' => '',
            ),
            104 =>
            array(
                'id' => 59316,
                'full_name' => 'BE BALANCE',
                'email' => 'bebalance@thelogx.com',
                'phone' => '971529199220',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            105 =>
            array(
                'id' => 59846,
                'full_name' => 'BE SWEET',
                'email' => 'bsweet@thelogx.com',
                'phone' => '971545180211',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'ABU DHABI',
                'created_dt' => '',
            ),
            106 =>
            array(
                'id' => 60684,
                'full_name' => 'Saba Plant Based',
                'email' => 'sabaplantbased@thelogx.com',
                'phone' => '971557243231',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Al Quoz',
                'created_dt' => '',
            ),
            107 =>
            array(
                'id' => 61344,
                'full_name' => 'Pro Bar Gym',
                'email' => 'probargym@thelogx.com',
                'phone' => '971585854493',
                'Password_partner' => 'i7h68i8t',
                'plain_password' => '',
                'address' => 'ras al khor',
                'created_dt' => '',
            ),
            108 =>
            array(
                'id' => 61469,
                'full_name' => 'MunchBox',
                'email' => 'munchbox@thelogx.com',
                'phone' => '971588781750',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Jabel Ali',
                'created_dt' => '',
            ),
            109 =>
            array(
                'id' => 62566,
                'full_name' => 'Go Organic',
                'email' => 'Goorganic@thelogx.com',
                'phone' => '971563906460',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai Investment Park',
                'created_dt' => '',
            ),
            110 =>
            array(
                'id' => 63586,
                'full_name' => 'Healthy Roots',
                'email' => 'Healthyroots@thelogx.com',
                'phone' => '971502016881',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Ajman',
                'created_dt' => '',
            ),
            111 =>
            array(
                'id' => 64252,
                'full_name' => 'The Health Co.',
                'email' => 'thehealthco@thelogx.com',
                'phone' => '971563283593',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'al quoz',
                'created_dt' => '',
            ),
            112 =>
            array(
                'id' => 65771,
                'full_name' => 'National Bonds',
                'email' => 'nationalbond@thelogx.com',
                'phone' => '9715781031544',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'AL QOUZ4',
                'created_dt' => '',
            ),
            113 =>
            array(
                'id' => 66279,
                'full_name' => 'The Luxe Basket',
                'email' => 'theluxebasket@thelogx.com',
                'phone' => '971503936812',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Jabel Ali',
                'created_dt' => '',
            ),
            114 =>
            array(
                'id' => 66345,
                'full_name' => 'Love Food Me',
                'email' => 'Admin1@lovefoodme.com',
                'phone' => '971-564200127',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Al Quoz',
                'created_dt' => '',
            ),
            115 =>
            array(
                'id' => 67901,
                'full_name' => 'Sharethelove',
                'email' => 'Sharethelove@thelogx.com',
                'phone' => '971-504464477',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Silicon Oasis',
                'created_dt' => '',
            ),
            116 =>
            array(
                'id' => 68783,
                'full_name' => 'Coba Cafe',
                'email' => 'cobacafe@thelogx.com',
                'phone' => '971556683998',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Al Quoz',
                'created_dt' => '',
            ),
            117 =>
            array(
                'id' => 70006,
                'full_name' => 'Warner Bros',
                'email' => 'warnerbros@thelogx.com',
                'phone' => '971-553957821',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            118 =>
            array(
                'id' => 71102,
                'full_name' => 'Nutrition Kitchen',
                'email' => 'NutritionKitchen@thelogx.com',
                'phone' => '971-5544805',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'Yas Island',
                'created_dt' => '',
            ),
            119 =>
            array(
                'id' => 74246,
                'full_name' => 'Do Not Use - OLD KARMA8',
                'email' => 'OLDKARMA8@thelogx.com',
                'phone' => '9715055000000',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Al Quoz 3',
                'created_dt' => '',
            ),
            120 =>
            array(
                'id' => 74922,
                'full_name' => 'Little Bento',
                'email' => 'littlebento@thelogx.com',
                'phone' => '9715055000014',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Al Quoz 3',
                'created_dt' => '',
            ),
            121 =>
            array(
                'id' => 75623,
                'full_name' => 'Lunch It',
                'email' => 'Lunchit@thelogx.com',
                'phone' => '971505500014',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Abu Dhabi',
                'created_dt' => '',
            ),
            122 =>
            array(
                'id' => 75877,
                'full_name' => 'Karma8',
                'email' => 'operations@karma8.ae',
                'phone' => '971-585126852',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            123 =>
            array(
                'id' => 76907,
                'full_name' => 'BEAN & BEYOND FARM L.L.C',
                'email' => 'Beanandbeyond@thelogx.com',
                'phone' => '97150124871',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DIP',
                'created_dt' => '',
            ),
            124 =>
            array(
                'id' => 76954,
                'full_name' => 'Prime Gourmet',
                'email' => 'primegourmet@thelogx.com',
                'phone' => '97150164145674',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Al Quoz 3',
                'created_dt' => '',
            ),
            125 =>
            array(
                'id' => 78250,
                'full_name' => 'BYou',
                'email' => 'BYou@thelogx.com',
                'phone' => '97150164145684',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            126 =>
            array(
                'id' => 79182,
                'full_name' => 'Nutri Bliss',
                'email' => 'NutriBliss@thelogx.com',
                'phone' => '971527547689',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Keto Life Kitchen',
                'created_dt' => '',
            ),
            127 =>
            array(
                'id' => 80144,
                'full_name' => 'MomIT',
                'email' => 'MomIT@thelogx.com',
                'phone' => '971504734517',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            128 =>
            array(
                'id' => 80497,
                'full_name' => 'Dr. Food - OLD',
                'email' => 'DrFood@thelogx.com',
                'phone' => '971501212852',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            129 =>
            array(
                'id' => 82043,
                'full_name' => 'Foodie IDIET',
                'email' => 'foodieIDIET@thelogx.com',
                'phone' => '971-585790147',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            130 =>
            array(
                'id' => 82672,
                'full_name' => 'Nom Nom Pet Treats',
                'email' => 'Nomnom@thelogx.com',
                'phone' => '556611367',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            131 =>
            array(
                'id' => 83058,
                'full_name' => 'Breads On Us',
                'email' => 'breadsonus@thelogx.com',
                'phone' => '971507891160',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            132 =>
            array(
                'id' => 83221,
                'full_name' => 'Right Farm',
                'email' => 'rightfarm@thelogx.com',
                'phone' => '9711245796307',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            133 =>
            array(
                'id' => 86949,
                'full_name' => 'Thawaaq Foodstuff',
                'email' => 'Thawaaq@thelogx.com',
                'phone' => '9715123647852',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            134 =>
            array(
                'id' => 88078,
                'full_name' => 'Nutri Eats',
                'email' => 'NutriEats@thelogx.com',
                'phone' => '971565484397',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            135 =>
            array(
                'id' => 88580,
                'full_name' => 'DUB Meals',
                'email' => 'dubmeals@thelogx.com',
                'phone' => '971147856923',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Foodie',
                'created_dt' => '',
            ),
            136 =>
            array(
                'id' => 90053,
                'full_name' => 'JT International Support Services',
                'email' => 'jti@thelogx.com',
                'phone' => '971551191765',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Foodie',
                'created_dt' => '',
            ),
            137 =>
            array(
                'id' => 90609,
                'full_name' => 'Sealed LLC',
                'email' => 'SealedLLC@thelogx.com',
                'phone' => '971503781011',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            138 =>
            array(
                'id' => 92565,
                'full_name' => 'Atelier Foodstuff Trading LLC',
                'email' => 'Atelier@thelogx.com',
                'phone' => '971147852369',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            139 =>
            array(
                'id' => 93653,
                'full_name' => 'VENDY FOR VENDING MACHINES TRADING',
                'email' => 'vendy@thelogx.com',
                'phone' => '971552109940',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            140 =>
            array(
                'id' => 93828,
                'full_name' => ' BEBOXA TRADING L.L.C',
                'email' => 'beboxa@thelogx.com',
                'phone' => '971585021700971',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            141 =>
            array(
                'id' => 93870,
                'full_name' => 'Traybae LLC',
                'email' => 'traybae@thelogx.com',
                'phone' => '971553017724',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            142 =>
            array(
                'id' => 94171,
                'full_name' => 'Fitkult',
                'email' => 'Fitkult@logx.com',
                'phone' => '971-545448445',
                'Password_partner' => 'i7z5n68p',
                'plain_password' => '',
                'address' => 'ALQOUZ 3',
                'created_dt' => '',
            ),
            143 =>
            array(
                'id' => 94477,
                'full_name' => 'Lei & Co ',
                'email' => 'lei&co@thelogx.com',
                'phone' => '971544444446',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            144 =>
            array(
                'id' => 94480,
                'full_name' => 'Moneypit',
                'email' => 'moneypit@thelogx.com',
                'phone' => '971533333333',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            145 =>
            array(
                'id' => 94936,
                'full_name' => 'PROTEIN HOUSE AL WASL - Marwa',
                'email' => 'marwa@logx.com',
                'phone' => '971-222554444',
                'Password_partner' => '3467896',
                'plain_password' => '3467896',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            146 =>
            array(
                'id' => 95442,
                'full_name' => 'Boxica',
                'email' => 'boxica@thelogx.com',
                'phone' => '9715555505050',
                'Password_partner' => '1234abcd',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            147 =>
            array(
                'id' => 95520,
                'full_name' => 'Practical',
                'email' => 'Practical@thelogx.com',
                'phone' => '97150145714',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            148 =>
            array(
                'id' => 95947,
                'full_name' => 'Pet Souq',
                'email' => 'petsouq@thelogx.com',
                'phone' => '971543898967',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            149 =>
            array(
                'id' => 96972,
                'full_name' => 'Boujee for imitation jewellery smithing',
                'email' => 'boujee@thelogx.com',
                'phone' => '971 56 644 8989',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Logx wear house B4 near gold and diamond park',
                'created_dt' => '',
            ),
            150 =>
            array(
                'id' => 96999,
                'full_name' => 'POKE SOUQ',
                'email' => 'admin@pokesouq.com',
                'phone' => '971501522348',
                'Password_partner' => 'Poke1234@',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            151 =>
            array(
                'id' => 97388,
                'full_name' => 'HOOF',
                'email' => 'hoof@thelogx.com',
                'phone' => '971 56 784 9498',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            152 =>
            array(
                'id' => 98075,
                'full_name' => 'Al Mahmasani',
                'email' => 'almahmasani@thelogx.com',
                'phone' => '971509532778',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            153 =>
            array(
                'id' => 98387,
                'full_name' => 'BE MORE HEALTHY',
                'email' => 'Bemorehealthy@thelogx.com',
                'phone' => '971501047457',
                'Password_partner' => 'rmmzrfl5',
                'plain_password' => '',
                'address' => 'Marsha Village marina',
                'created_dt' => '',
            ),
            154 =>
            array(
                'id' => 99025,
                'full_name' => 'Ree7an Kitchen',
                'email' => 'Ree7an@thelogx.com',
                'phone' => '971508738524',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Business bay  executive bay tower Alamal street Shop number 16 Backside of the building',
                'created_dt' => '',
            ),
            155 =>
            array(
                'id' => 102522,
                'full_name' => 'House Of Tagine',
                'email' => 'houseoftagine@thelogx.com',
                'phone' => '971-556993974',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            156 =>
            array(
                'id' => 103171,
                'full_name' => 'Dr. Food.ae',
                'email' => 'DrFood.ae@thelogx.com',
                'phone' => '971501212966',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Eat well Kitchen',
                'created_dt' => '',
            ),
            157 =>
            array(
                'id' => 103463,
                'full_name' => 'Ali Al Hashmi Trading LLC',
                'email' => 'alialhashmitrading@thelogx.com',
                'phone' => '971544417998',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            158 =>
            array(
                'id' => 103610,
                'full_name' => 'PRODIGY',
                'email' => 'prodigy@thelogx.com',
                'phone' => '971555157662',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'DUBAI',
                'created_dt' => '',
            ),
            159 =>
            array(
                'id' => 104986,
                'full_name' => 'Fit N Fast Restaurant',
                'email' => 'FitNFast@thelogx.com',
                'phone' => '971-526049366',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Al Mizhar 1 - Dubai',
                'created_dt' => '',
            ),
            160 =>
            array(
                'id' => 105384,
                'full_name' => 'TYF',
                'email' => 'TYF@thelogx.com',
                'phone' => '971-526188628',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Pura Kitchen',
                'created_dt' => '',
            ),
            161 =>
            array(
                'id' => 105772,
                'full_name' => 'IDIET Pastry',
                'email' => 'idietpastry@thelogx.com',
                'phone' => '971-588147117',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Foodie',
                'created_dt' => '',
            ),
            162 =>
            array(
                'id' => 107236,
                'full_name' => 'Pinoy Delicacies',
                'email' => 'pinoydelicacies@thelogx.com',
                'phone' => '971-552012983',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Abu Dhabi',
                'created_dt' => '',
            ),
            163 =>
            array(
                'id' => 107930,
                'full_name' => 'Healthy Corner ',
                'email' => 'HealthyCorner@thelogx.com',
                'phone' => '971-509889116',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            164 =>
            array(
                'id' => 108433,
                'full_name' => 'Yummy Bento',
                'email' => 'YummyBento@thelogx.com',
                'phone' => '971-509199278',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            165 =>
            array(
                'id' => 108586,
                'full_name' => 'Life Mart',
                'email' => 'LIfeMart@thelogx.com',
                'phone' => '79883878775',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            166 =>
            array(
                'id' => 108941,
                'full_name' => 'TrainX',
                'email' => 'Trainx@thelogx.com',
                'phone' => '971543125516',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            167 =>
            array(
                'id' => 109862,
                'full_name' => 'FitBar',
                'email' => 'FitBar@thelogx.com',
                'phone' => '971542798259',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            168 =>
            array(
                'id' => 110913,
                'full_name' => 'Colnago Cafe',
                'email' => 'ColnagoCafe@thelogx.com',
                'phone' => '971568155452',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            169 =>
            array(
                'id' => 111869,
                'full_name' => 'Quality Food',
                'email' => 'qualityfood@thelogx.com',
                'phone' => '971524353400',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            170 =>
            array(
                'id' => 111895,
                'full_name' => 'The White Boutique',
                'email' => 'TheWhiteBoutique@thelogx.com',
                'phone' => '971506444155',
                'Password_partner' => 'ge0hymmi',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            171 =>
            array(
                'id' => 111969,
                'full_name' => 'Cloc',
                'email' => 'Cloc@thelogx.com',
                'phone' => '971585549342',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            172 =>
            array(
                'id' => 113711,
                'full_name' => 'Grams',
                'email' => 'grams@thelogx.com',
                'phone' => '971501089895',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Abu Dhabi',
                'created_dt' => '',
            ),
            173 =>
            array(
                'id' => 113930,
                'full_name' => 'Sweet Greens',
                'email' => 'sweetgreens@thelogx.com',
                'phone' => '971-586503491',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            174 =>
            array(
                'id' => 114949,
                'full_name' => 'Healthy Dose',
                'email' => 'healthydose@thelogx.com',
                'phone' => '971-564065654',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'Dubai',
                'created_dt' => '',
            ),
            175 =>
            array(
                'id' => 115638,
                'full_name' => 'Energy Meal Plan',
                'email' => 'emp@thelogx.com',
                'phone' => '971-585807846',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
            176 =>
            array(
                'id' => 116254,
                'full_name' => 'Mechanics ',
                'email' => 'Mechanics@thelogx.com',
                'phone' => '971566154762',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => '...',
                'created_dt' => '',
            ),
            177 =>
            array(
                'id' => 116255,
                'full_name' => 'Prep Meals',
                'email' => 'prepmeals@thelogx.com',
                'phone' => '971 54 309 9677',
                'Password_partner' => 'Logx4321',
                'plain_password' => '',
                'address' => 'dubai',
                'created_dt' => '',
            ),
        );

        dd();
    }

    public function testUploadDBCustomers(Request $request)
    {

        ini_set('max_execution_time', 30000000000);

        // ini_set('upload_max_filesize', 365658992);
        // ini_set('post_max_size', 365658992);
        //  0 => "id"
        //   1 => "uniqueid"
        //   2 => "email"
        //   3 => "phone"
        //   4 => "password"
        //   5 => "password_partner"
        //   6 => "full_name"
        //   6 => "vendor"

        //   7 => "vendor_id"
        //   8 => "address"
        //   9 => "postcode"
        //   10 => "state"
        //   11 => "country"
        //   12 => "status"
        //   13 => "is_deleted"
        //   14 => "is_child"
        //   15 => "created_dt"
        //   16 => "send_notification"
        //   17 => "mul_address"
        //   18 => "all_detail" removed
        //   19 => "addr_loc_by_dri_usr"
        //   20 => "addr_img_usr"
        //   21 => "mealplan_check"
        //   22 => "special_instruction"
        // =================== M E T H O D  - 1
        $faulted_records = [];

        // dd($request->excel_file);
        if ($request->hasFile('excel_files')) {
            $files = $request->excel_files;
            $num_freq = [];
            $total_records_checked = 0;
            $total_records_added = 0;
            $duplication_ignored_numbers = 0;
            $duplication_ignored_users = 0;

            foreach ($files as $file) {

                $data = $this->helper->getExcelSheetData($file);
                $header = $data[0];
                $header = array_map(fn ($v) => trim(str_replace([' ', '(', ')'], ['_', '', ''], strtolower(preg_replace('/\(([^)]+)\)/', '$1', $v))), '_'), $header);
                unset($data[0]);

                $addition_count = 0;

                foreach ($data as  $row) {
                    $total_records_checked++;
                    echo "<script>window.scrollTo(0, document.body.scrollHeight);</script>";
                    $row = array_combine($header, $row);
                    $phone_number = $this->helper->formatPhoneNumber($row['phone']);
                    echo "<br> Adding new record.... <br>";

                    try {
                        DB::beginTransaction();
                        $same_user  =  $this->userRepository->getSingleUserWhere(['phone' => $phone_number, 'name' => $row['full_name']]);
                        if ($same_user == null) {
                            $duplication_ignored_users++;
                            if (array_key_exists($phone_number, $num_freq)) {
                                $duplication_ignored_numbers++;
                                $num_freq[$phone_number]++;
                                array_push($faulted_records, $row);
                                echo "<br><br> ================" . $row['phone'] . " N U M B E R   A L R E A D Y   A D D E D ===================== <br>";
                            } else {
                                $total_records_added++;
                                $num_freq[$phone_number] = 1;


                                $user =  $this->userRepository->getSingleUserWhere(['phone' => $phone_number]);
                                if (!$user) {
                                    $user =  $this->userRepository->createUser([
                                        'name' => $row['full_name'] ?? "",
                                        'email' => $row['email'] == "" ? null : $row['email'],
                                        'phone' => $phone_number == "" ? null : $phone_number,
                                        'password' => Hash::make($row['password_partner']),
                                    ], false);

                                    $role_id = $this->roleRepository->getRoleByName(RoleNamesEnum::CUSTOMER->value);
                                    $this->userRoleRepository->createUserRole(userId: $user->id, roleId: $role_id->id);
                                }
                                echo "<br> ===============user " . json_encode($user) . "====================== <br>";


                                $customer = $this->customerRepository->create([
                                    'user_id' => $user->id,
                                    'is_notification_enabled' => $row['send_notification'] == "Yes" ? true : false,
                                ]);

                                echo "<br> ===============customer " . json_encode($customer) . "====================== <br>";


                                if ($row['special_instruction'] != null && $row['special_instruction'] != "NULL") {
                                    $this->specialInstructionRepository->create([
                                        "special_instruction" => $row["special_instruction"],
                                        "customer_id" => $customer->id,
                                    ]);
                                }
                                $business =  $this->businessRepository->getSingleBusinessWhere(['name' => $row['vendor']]);
                                echo "<br> ===============business " . json_encode($business->id) . "====================== <br>";

                                $business_customer =  $this->businessCustomerRepository->create(
                                    customer_id: $customer->id,
                                    business_id: $business->id,
                                );

                                echo "<br> ===============business_customer " . json_encode($business_customer) . "====================== <br>";

                                // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                                // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  A D D R E S S   S T A R T  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
                                // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                                // Extracting address from mul_address json to array in below code 
                                $mul_addresses = [];
                                if ($row['mul_address'] != "" && $row['mul_address'] != null) {

                                    $arrayData = json_decode($row['mul_address'], true);
                                    $filteredAddresses = array_filter($arrayData, function ($item) {
                                        return !empty($item['address']);
                                    });

                                    $mul_addresses = array_column($filteredAddresses, 'address');
                                }
                                // $address_xy = $row['addr_loc_by_dri_usr'] != "" ? (object) ['latitude' => $sheet_xy[0], 'longitude' => $sheet_xy[1]] :  $this->helper->convertStringAddressToCoordinates($row['address']);

                                // echo "<br> ===============." . $row['addr_loc_by_dri_usr'] . ".address_xy " . json_encode($sheet_xy) . "====================== <br>";


                                echo "<br> ===============mul_addresses " . gettype($mul_addresses) . " " . json_encode($mul_addresses) . "====================== <br>";

                                // if cordinates available add that seperately 
                                if ($row['addr_loc_by_dri_usr'] != "") {
                                    echo "<br> =============== addr_loc_by_dri_usr " . gettype($row['addr_loc_by_dri_usr']) . " " . json_encode($row['addr_loc_by_dri_usr']) . "====================== <br>";

                                    $sheet_coordinates_xy = explode(",",  $row['addr_loc_by_dri_usr']);

                                    echo "<br> =============== sheet_coordinates_xy " . gettype($sheet_coordinates_xy) . " " . json_encode($sheet_coordinates_xy) . "====================== <br>";

                                    $address_xy = (object) ['latitude' => $sheet_coordinates_xy[0], 'longitude' => $sheet_coordinates_xy[1]];

                                    if ($address_xy == null) {
                                        array_push($faulted_records, $row);
                                    } else {
                                        $address =  $address_xy ? $this->helper->getLocationFromCoordinates($address_xy->latitude, $address_xy->longitude) : null;
                                        echo "<br><br> ===================================== <br>";
                                        echo "<br> R O W with coordinates: " . $row['full_name'] . " and address_xy" . json_encode($address_xy) . " and address " . json_encode($address) . "<br>";
                                        echo "<br> ===================================== <br>";

                                        $db_location_ids = $this->helper->findDBLocationsWithNames(
                                            $address['country'],
                                            $address['state'],
                                            $address['city'],
                                            $address['area'],
                                        );
                                        echo "<br> ===============db_location_ids " . json_encode($db_location_ids) . "====================== <br>";

                                        if ($db_location_ids['country_id'] == "" || $db_location_ids['state_id'] == "" || $db_location_ids['city_id'] == "") {
                                            array_push($faulted_records, $row);
                                        } else {


                                            $address_data = [
                                                'address' => $row['address'],
                                                'address_type' => "OTHER",
                                                'latitude' => $address_xy ? $address_xy->latitude : null,
                                                'longitude' => $address_xy ? $address_xy->longitude : null,
                                                'customer_id' => $customer->id,
                                                'address_status' => $address_xy ? AddressStatusEnum::COORDINATES_MANUAL_APPORVAL_REQUIRED->value : AddressStatusEnum::NO_COORDINATES->value,
                                                'area_id' => $db_location_ids['area_id'] == "" ? null : $db_location_ids['area_id'],
                                                'city_id' => $db_location_ids['city_id'],
                                                'state_id' => $db_location_ids['state_id'],
                                                'country_id' => $db_location_ids['country_id'],
                                            ];

                                            $customer_address = $this->customerAddressRepository->create($address_data);

                                            echo "<br> ===============customer_address " . json_encode($customer_address) . "====================== <br>";

                                            echo "<br> >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> <br>";
                                        }
                                    }
                                    // if address available add it with mul address 

                                } elseif ($row['address'] != "" && $row['address'] == null) {
                                    array_push($mul_addresses, $row['address']);
                                    echo "<br> ===============address in elseif " . json_encode($row['address']) . " " . json_encode($mul_addresses) . "====================== <br>";
                                }


                                echo "<br> =============== mul_addresses before for loop " . gettype($mul_addresses) . " " . json_encode($mul_addresses) . "====================== <br>";

                                foreach ($mul_addresses as $single_address) {


                                    $address_xy = $this->helper->convertStringAddressToCoordinates($single_address);
                                    echo "<br> ===============address_xy " . json_encode($address_xy) . "====================== <br>";

                                    if ($address_xy == null) {
                                        array_push($faulted_records, $row);
                                    } else {
                                        $address =  $address_xy ? $this->helper->getLocationFromCoordinates($address_xy->latitude, $address_xy->longitude) : null;
                                        echo "<br><br> ===================================== <br>";
                                        echo "<br> R O W : " . $row['full_name'] . " and address_xy" . json_encode($address_xy) . " and address " . json_encode($single_address) . "<br>";
                                        echo "<br> ===================================== <br>";

                                        $db_location_ids = $this->helper->findDBLocationsWithNames(
                                            $address['country'],
                                            $address['state'],
                                            $address['city'],
                                            $address['area'],
                                        );
                                        echo "<br> ===============db_location_ids " . json_encode($db_location_ids) . "====================== <br>";

                                        if ($db_location_ids['country_id'] == "" || $db_location_ids['state_id'] == "" || $db_location_ids['city_id'] == "") {
                                            array_push($faulted_records, $row);
                                        } else {


                                            $address_data = [
                                                'address' => $single_address,
                                                'address_type' => "OTHER",
                                                'latitude' => $address_xy ? $address_xy->latitude : null,
                                                'longitude' => $address_xy ? $address_xy->longitude : null,
                                                'customer_id' => $customer->id,
                                                'address_status' => $address_xy ? AddressStatusEnum::COORDINATES_MANUAL_APPORVAL_REQUIRED->value : AddressStatusEnum::NO_COORDINATES->value,
                                                'area_id' => $db_location_ids['area_id'] == "" ? null : $db_location_ids['area_id'],
                                                'city_id' => $db_location_ids['city_id'],
                                                'state_id' => $db_location_ids['state_id'],
                                                'country_id' => $db_location_ids['country_id'],
                                            ];

                                            $customer_address = $this->customerAddressRepository->create($address_data);
                                            echo "<br> ===============customer_address " . json_encode($customer_address) . "====================== <br>";

                                            echo "<br> >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> <br>";
                                        }
                                    }
                                }
                            }
                        } else {
                            echo "<br><br> ================" . $row['full_name'] . " A L R E A D Y   A D D E D ===================== <br>";
                        }
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollback();
                        return 'Data upload failed: ' . $e->getMessage();
                    }
                }
                echo "<br><br> ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// <br>";
                flush();
            }

            echo "<br><br> ================ total_records_added: " . $total_records_added . " ===================== <br>";
            echo "<br><br> ================ total_records_checked: " . $total_records_checked . " ===================== <br>";
            echo "<br><br> ================ duplication_ignored_numbers: " . $duplication_ignored_numbers . " ===================== <br>";
            echo "<br><br> ================ duplication_ignored_users: " . $duplication_ignored_users . " ===================== <br>";



            echo "<br><br><pre> Faulted records: " .    print_r(count($faulted_records)) . "<pre><br>";



            arsort($num_freq);


            if (count($faulted_records) > 0) {
                $export = new CustomExportExcel($faulted_records);

                // Generate and download the Excel file for each iteration
                Excel::download($export, 'file_name.xlsx');
            }
            dd($faulted_records);
        } else {
            dd("no excel files");
        }
    }
}
