<?php

namespace Modules\BusinessService\Http\Controllers\PartnerPortal;

use App\Http\Helper\Helper;
use App\Interfaces\CountryInterface;
use App\Interfaces\UserInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;
use Modules\BusinessService\Interfaces\CustomerInterface;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private CustomerInterface $customersRepository;
    private CustomerAddressInterface $customerAddressRepository;
    private CountryInterface $countryRepository;
    private UserInterface $userRepository;
    private Helper $helper;


    public function __construct(
        CustomerInterface $customersRepository,
        CustomerAddressInterface $customerAddressRepository,
        CountryInterface $countryRepository,
        UserInterface $userRepository,
        Helper $helper

    ) {
        $this->customersRepository = $customersRepository;
        $this->customerAddressRepository = $customerAddressRepository;
        $this->countryRepository = $countryRepository;
        $this->userRepository = $userRepository;
        $this->helper = $helper;
    }

    public function viewAllCustomers()
    {
        $customers = $this->customersRepository->get();
        return view('businessservice::partner_portal.customers.customers', ['customers' => $customers]);
    }

    public function viewAddCustomer()
    {
        $customers = $this->customersRepository->get();
        $countries = $this->countryRepository->getAllActiveCountries();
        return view('businessservice::partner_portal.customers.add_new_customer', ['customers' => $customers, 'countries' => $countries]);
    }

    public function storeNewCustomer(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $phone = $request->phone;
        $address = $request->address;
        $map_address = $request->map_address;
        $address_country = $request->country;
        $address_state = $request->state;
        $address_city = $request->city;
        $address_area = $request->area;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $is_notifications_enabled = $request->is_notifications_enabled;
        // --  Selected address from google map locations
        if ($request->latitude != 0) {
            $map_location_names = $this->helper->getLocationFromCoordinates($latitude, $longitude);
            $db_map_location_ids = $this->helper->findDBLocationsWithNames($map_location_names['country'], $map_location_names['state'], $map_location_names['city'], $map_location_names['area']);

            $address_country = $db_map_location_ids['country_id'] != '' ? $db_map_location_ids['country_id'] : null;
            $address_state = $db_map_location_ids['state_id'] != '' ? $db_map_location_ids['state_id'] : null;
            $address_city = $db_map_location_ids['city_id'] != '' ? $db_map_location_ids['city_id'] : null;
            $address_area = $db_map_location_ids['area_id'] != '' ?  $db_map_location_ids['area_id'] : null;
        }

        try {
            // --- Adding data in users table
            // abort_if(Gate::denies('add_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $user = $this->userRepository->createUser([
                'name' => $name,
                'email' =>  $email,
                'phone' => $phone,
                'password' => Hash::make($password),
                'isActive' => true
            ], false);


            $customer = $this->customersRepository->create(
                [
                    'user_id' => $user->id,
                    'is_notifications_enabled' => $is_notifications_enabled ?? true
                ]
            );
            $data = [
                'address' => $map_address,
                'address_type' => "DEFAULT",
                'latitude' => $latitude,
                'longitude' => $longitude,
                'area_id' => $address_area,
                'city_id' => $address_city,
                'state_id' => $address_state,
                'country_id' => $address_country,
                'customer_id' => $customer->id,
            ];
            $this->customerAddressRepository->create($data);
            return redirect()->back()->with("success", "Customer Added Successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("business_home")->with("error", "Something went wrong! Contact support");
        }
        // return view('businessservice::partner_portal.customers.add_new_customer', ['customers' => $customers, 'countries' => $countries]);
    }
}
