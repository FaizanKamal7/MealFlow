<?php

namespace Modules\BusinessService\Http\Controllers\PartnerPortal;

use App\Enum\AddressStatusEnum;
use App\Enum\AddressTypeEnum;
use App\Enum\RoleNamesEnum;
use App\Http\Helper\Helper;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\CountryInterface;
use App\Interfaces\DeliverySlotInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\UserRoleInterface;
use App\Repositories\AreaRepository;
use App\Repositories\CityRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;
use Modules\BusinessService\Interfaces\CustomerInterface;
use Modules\DeliveryService\Interfaces\DeliveryTypeInterface;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private CustomerInterface $customerRepository;
    private CustomerAddressInterface $customerAddressRepository;
    private CountryInterface $countryRepository;
    private UserInterface $userRepository;
    private $businessRepository;
    private $businessCustomerRepository;
    private UserRoleInterface $userRoleRepository;
    private RoleInterface $roleRepository;
    public Helper $helper;
    private $areaRepository;
    private $cityRepository;
    private $deliverySlotRepository;
    private $deliveryTypeRepository;


    public function __construct(
        CustomerInterface $customerRepository,
        CustomerAddressInterface $customerAddressRepository,
        CountryInterface $countryRepository,
        UserInterface $userRepository,
        BusinessInterface $businessRepository,
        BusinessCustomerInterface $businessCustomerRepository,
        RoleInterface $roleRepository,
        UserRoleInterface $userRoleRepository,
        AreaInterface $areaRepository,
        CityInterface       $cityRepository,
        DeliverySlotInterface  $deliverySlotRepository,
        DeliveryTypeInterface $deliveryTypeRepository,
        Helper $helper

    ) {
        $this->customerRepository = $customerRepository;
        $this->customerAddressRepository = $customerAddressRepository;
        $this->countryRepository = $countryRepository;
        $this->userRepository = $userRepository;
        $this->businessRepository = $businessRepository;
        $this->businessCustomerRepository = $businessCustomerRepository;
        $this->roleRepository = $roleRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->areaRepository = $areaRepository;
        $this->deliveryTypeRepository = $deliveryTypeRepository;
        $this->deliverySlotRepository = $deliverySlotRepository;
        $this->cityRepository = $cityRepository;
        $this->helper = $helper;
    }

    public function viewAllCustomers()
    {
        if (Gate::denies('view_all_customers')) {
            $business_customers = $this->businessCustomerRepository->getBusinessCustomer(Auth::user()->business_users[0]->business_id);
            $customers = $business_customers->pluck('customer')->filter();
        } else {
            $customers = $this->customerRepository->get();
        }
        return view('businessservice::partner_portal.customers.customers', ['customers' => $customers]);
    }

    public function viewAddCustomer()
    {
        $customers = $this->customerRepository->get();
        $countries = $this->countryRepository->getAllActiveCountries();
        $businesses = $this->businessRepository->getActiveBusinesses();

        return view('businessservice::partner_portal.customers.add_new_customer', ['customers' => $customers, 'countries' => $countries, 'businesses' => $businesses]);
    }

    public function storeNewCustomer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required',
        ]);
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $phone = $request->phone;
        $address = $request->map_address ?? $request->address;
        $business_id = $request->business_id;
        $address_country = $request->country;
        $address_state = $request->state;
        $address_city = $request->city;
        $address_area = $request->area;
        $latitude = $request->latitude;   // From google map API
        $longitude = $request->longitude; // From google map API
        $is_notifications_enabled = $request->is_notifications_enabled;
        // ---  Below if is checking if address came via google map API if not get lat and long
        if (isset($request->latitude) && $request->latitude != 0) {
            $map_location_names = $this->helper->getLocationFromCoordinates($latitude, $longitude);
            $db_map_location_ids = $this->helper->findDBLocationsWithNames($map_location_names['country'], $map_location_names['state'], $map_location_names['city'], $map_location_names['area']);

            $address_country = $db_map_location_ids['country_id'] != '' ? $db_map_location_ids['country_id'] : null;
            $address_state = $db_map_location_ids['state_id'] != '' ? $db_map_location_ids['state_id'] : null;
            $address_city = $db_map_location_ids['city_id'] != '' ? $db_map_location_ids['city_id'] : null;
            $address_area = $db_map_location_ids['area_id'] != '' ?  $db_map_location_ids['area_id'] : null;
        } else {
            $address_coordinates = $this->helper->convertStringAddressToCoordinates($address);
            $latitude = $address_coordinates ? $address_coordinates->latitude : null;
            $longitude = $address_coordinates ? $address_coordinates->longitude : null;
        }

        try {
            DB::beginTransaction();
            // --- Adding data in users table
            // abort_if(Gate::denies('add_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $customer = $this->customerRepository->customerWithMatchingPhoneNoInUsers($phone);
            if (!$customer && ($email != '' || $email != null)) {
                $this->customerRepository->customerWithMatchingEmailInUsers($email);
            }
            $customer_addresses = '';
            $address_matching = null;


            if ($customer) {
                return redirect()->back()->with('error', 'Customer already exist');
            } else {
                $user = $this->userRepository->createUser([
                    'name' => $name,
                    'email' => $email ?? null,
                    'phone' => $phone,
                    'password' => Hash::make($password),
                    'isActive' => true
                ], false);

                $customer = $this->customerRepository->create(['user_id' => $user->id, 'is_notification_enabled' => $is_notifications_enabled]);
                $this->businessCustomerRepository->create(customer_id: $customer->id, business_id: $request->business_id);
                $role = $this->roleRepository->getRoleByName(RoleNamesEnum::CUSTOMER->value);
                $this->userRoleRepository->createUserRole(userId: $user->id, roleId: $role->id);
            }

            $finalized_address = '';

            $address_data = [
                'address' =>  $address,
                'address_type' => AddressTypeEnum::DEFAULT->value,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'customer_id' => $customer->id,
                'address_status' => $latitude ? AddressStatusEnum::COORDINATES_MANUAL_APPORVAL_REQUIRED->value : AddressStatusEnum::NO_COORDINATES->value,
                'area_id' => $address_area,
                'city_id' => $address_city,
                'state_id' => $address_state,
                'country_id' => $address_country,
            ];
            $this->customerAddressRepository->create($address_data);


            // if ($address_matching == null || ($address_matching && $address_matching['status'] == 'MISSING')) {
            //     $this->customerAddressRepository->create($address_data);
            // }
            // elseif ($address_matching['status'] == 'CONFLICT') {
            //     $location_info = [
            //         'area_id' => $area->id,
            //         'city_id' => $city->id,
            //         'state_id' => $city->state->id,
            //         'country_id' => $city->state->country->id,
            //     ];
            //     $delivery_data = array_merge($delivery_data, $location_info);
            //     $conflicted_delivery = [
            //         'conflict' => 'Similar address for customer already exists',
            //         'db_customer' => $customer,
            //         'customer_db_address' => $address_matching['customer_db_address'],
            //         'passed_address' => $address_matching['passed_address'],
            //         'passed_delivery_data' => $delivery_data,
            //     ];
            //     array_push($conflicted_customers, $conflicted_delivery);
            //     continue;
            // } 
            // elseif ($address_matching['status'] == 'MATCHED') {

            //     $finalized_address = $address_matching['customer_db_address'];
            // }




            DB::commit();
            return redirect()->back()->with("success", "Customer Added Successfully");
        } catch (Exception $exception) {
            DB::rollback();
            Log::error($exception);
            return redirect()->route("business_home")->with("error", "Something went wrong! Contact support");
        }
        // return view('businessservice::partner_portal.customers.add_new_customer', ['customers' => $customers, 'countries' => $countries]);
    }


    public function storeNewCustomersExcelInfo(Request $request)
    {
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

        $validator = Validator::make($request->all(), [
            'business_id' => 'required',
            'excel_file' => 'required|mimes:xlsx,xls,csv'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $file = $request->file('excel_file');

        $data = $this->helper->getExcelSheetData($file);

        // Create chunks of data with 10 rows each
        $chunks = array_chunk($data, 10);

        $header = $chunks[0][0];
        $header = array_map(fn ($v) => trim(str_replace([' ', '(', ')'], ['_', '', ''], strtolower(preg_replace('/\(([^)]+)\)/', '$1', $v))), '_'), $header);
        unset($chunks[0][0]);
        $batch = Bus::batch([])->dispatch();
        $conflicted_customers = [];
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
                            $role_id = $this->roleRepository->getRoleByName(RoleNamesEnum::CUSTOMER->value);
                            $this->userRoleRepository->createUserRole(userId: $user->id, roleId: $role_id->id);

                            $customer = $this->customerRepository->create(['user_id' => $user->id]);
                            $this->businessCustomerRepository->create(customer_id: $customer->id, business_id: $request->business_id);
                        }

                        // --- Get DB Branch


                        $delivery_slot = $this->helper->extractDeliverySlotFromCityWithTime($row['city_with_time_select_option']);
                        $db_delivery_slot = $this->deliverySlotRepository->getDeliverySlotsByTimeAndCity($delivery_slot->start_time, $delivery_slot->end_time, $city->id);

                        $address_coordinates = $this->helper->convertStringAddressToCoordinates($sheet_address);
                        $latitude = $address_coordinates ? $address_coordinates->latitude : null;
                        $longitude = $address_coordinates ? $address_coordinates->longitude : null;

                        $finalized_address = '';
                        $address_data = [
                            'address' => $sheet_address,
                            'address_type' => AddressTypeEnum::DEFAULT->value,
                            'latitude' => $latitude,
                            'longitude' => $longitude,
                            'customer_id' => $customer->id,
                            'address_status' => $new_address_coordinates ? AddressStatusEnum::COORDINATES_MANUAL_APPORVAL_REQUIRED->value : AddressStatusEnum::NO_COORDINATES->value,
                            'area_id' => $area->id,
                            'city_id' => $city->id,
                            'state_id' => $city->state->id,
                            'country_id' => $city->state->country->id,
                        ];

                        if ($address_matching == null || ($address_matching && $address_matching['status'] == 'MISSING')) {
                            $this->customerAddressRepository->create($address_data);
                        } elseif ($address_matching['status'] == 'CONFLICT') {

                            $conflicted_deta = [
                                'conflict' => 'Similar address for customer already exists',
                                'db_customer' => $customer,
                                'customer_db_address' => $address_matching['customer_db_address'],
                                'passed_address' => $address_matching['passed_address'],
                                'address_data' => $address_data,
                            ];
                            array_push($conflicted_customers, $conflicted_deta);
                            continue;
                        } else {
                            $this->customerAddressRepository->makeDefaultAddress($address_matching['customer_db_address']->id, $customer->id);
                        }
                    }
                } else {
                    return redirect()->back()->with('error', 'Uploaded file is not following excpected excel format.');
                }
                // TODO: upload deliveries via JOB
                // $batch->add(new UploadDeliveriesCSVJob($chunk));
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                return 'Data upload failed: ' . $e->getMessage();
            }
        }

        if (count($conflicted_customers) == 0) {
            return redirect()->back()->with('success', 'Valid customers uploaded successfully.');
        } else {
            return view('businessservice::partner_portal.customers.conflicted_customers_view', ['conflicted_customers' => $conflicted_customers]);
        }
    }
}
