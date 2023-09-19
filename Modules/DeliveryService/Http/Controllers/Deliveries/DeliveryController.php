<?php

namespace Modules\DeliveryService\Http\Controllers\Deliveries;

use App\Http\Helper\Helper;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\DeliverySlotInterface;
use App\Interfaces\UserInterface;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Modules\BusinessService\Entities\BusinessCustomer;
use Modules\BusinessService\Entities\Customer;
use Modules\BusinessService\Entities\CustomerAddress;
use Modules\BusinessService\Interfaces\BranchInterface;
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;
use Modules\BusinessService\Interfaces\CustomerInterface;
use Modules\BusinessService\Interfaces\CustomerSecondaryNumberInterface;
use Modules\BusinessService\Repositories\BranchRepository;
use Modules\BusinessService\Repositories\BusinessRepository;
use Modules\DeliveryService\Entities\Delivery;
use Modules\DeliveryService\Http\Exports\DeliveryTemplateClass;
use Modules\DeliveryService\Http\Exports\ExcelImportClass;
use Modules\DeliveryService\Interfaces\DeliveryInterface;
use Modules\DeliveryService\Interfaces\DeliveryTypeInterface;
use Modules\DeliveryService\Jobs\UploadDeliveriesCSV;
use Modules\DeliveryService\Jobs\UploadDeliveriesCSVJob;

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
        $this->helper = $helper;
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
    public function uploadDeliveries()
    {
        $businesses = $this->businessRepository->getActiveBusinesses();
        return view('deliveryservice::deliveries.upload_delivery', ['businesses' =>  $businesses]);
    }

    public function uploadDeliveriesByForm(Request $request)
    {
        $customers = $request->get("customer");
        $addresses = $request->get("delivery_address");
        $deliverySlots = $request->get("delivery_slot");
        $itemTypes = $request->get("item_type");
        $instructions = $request->get("special_instructions");
        $notes = $request->get("notes");
        $codAmounts = $request->get("cod_amount");

        $totalRecords =  count($customers);
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
        $data = $this->helper->getExcelSheetData($file);

        // Create chunks of data with 10 rows each
        $chunks = array_chunk($data, 10);

        $header = $chunks[0][0];
        $header = array_map(fn ($v) => trim(str_replace([' ', '(', ')'], ['_', '', ''], strtolower(preg_replace('/\(([^)]+)\)/', '$1', $v))), '_'), $header);
        unset($chunks[0][0]);
        $batch  = Bus::batch([])->dispatch();
        $conflicted_deliveries = [];
        foreach ($chunks as $key => $chunk) {
            // try {
            //     DB::beginTransaction();

            if ($this->headersMatch($header, $expected_headers)) {
                foreach ($chunk as $chunk_item_id => $row) {
                    $row = array_combine($header, $row);
                    $chunks[$key][$chunk_item_id] = $row;
                    $chunk[$chunk_item_id] = $row;


                    $sheet_area_with_city = $row['area_with_city_select_option'];
                    $city_name = '';
                    $area_name = '';
                    $branch_id = '';
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
                    $customer = $customer ??  $this->customerRepository->customerWithMatchingEmailInUsers($row['email_optional']);
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
                            'email' => $row['email_optional'] ?? '',
                            'password' => Hash::make("1234abcd"),
                            'isActive' => true
                        ]);

                        $customer = $this->customerRepository->create(['user_id' => $user->id]);
                        $this->businessCustomerRepository->create(['customer_id' => $customer->id, 'business_id' => $request->business_id]);
                    }

                    // --- Get DB Branch

                    $business_branches = $this->branchRepository->getBusinessBranches($request->business_id);

                    foreach ($business_branches as $branch) {
                        if ($branch->name == $row['pickup_point']) {
                            $branch_id = $branch->id;
                            break;
                        }
                    }

                    $delivery_type = $this->deliveryTypeRepository->getWhereFirst(['name' => $row['product_type_optional']]);




                    // $timeObject = TimeExtractor::extractTime($inputString);

                    $delivery_slot = $this->helper->extractDeliverySlotFromCityWithTime($row['city_with_time_select_option']);
                    echo ('<pre> delivery_slot below' . $row['city_with_time_select_option'] . ' <pre>');
                    echo ('<pre> ' . var_dump($delivery_slot->start_time) . ' <pre>');
                    echo ('<pre> ' . var_dump($delivery_slot->end_time) . ' <pre>');
                    echo ('<pre> ' . var_dump($city->id) . ' <pre>');

                    $db_delivery_slot = $this->deliverySlotRepository->getDeliverySlotsByTimeAndCity($delivery_slot->start_time, $delivery_slot->end_time, $city->id);
                    // echo ('<pre> Done with slots <pre> ');
                    // echo ('<pre> Address: ' . $finalized_address->id . ' <pre>');
                    // echo ('<pre> customer: ' . $customer->id . ' <pre>');
                    // echo ('<pre> SLOT: ' . var_dump($db_delivery_slot->id) . ' <pre>');



                    $finalized_address = '';

                    if ($address_matching == null || ($address_matching && $address_matching['status'] == 'MISSING')) {

                        // add new and get customer id
                        $new_address_coordinates = $this->helper->convertStringAddressToCoordinates($sheet_address);

                        $address_data = [
                            'address' =>  $sheet_address,
                            'address_type' =>  "OTHER",
                            'latitude' =>  $new_address_coordinates ? $new_address_coordinates->latitude : null,
                            'longitude' =>  $new_address_coordinates ? $new_address_coordinates->longitude : null,
                            'customer_id' =>  $customer->id,
                            'address_status' => $new_address_coordinates ? "NO_COORDINATES" : "MANUAL_APPORVAL_REQUIRED",
                            'area_id' =>  $area->id,
                            'city_id' =>  $city->id,
                            'state_id' =>  $city->state->id,
                            'country_id' =>  $city->state->country->id,
                        ];
                        echo ('<pre> ---> Sheet Address : ' . $sheet_address . '<pre>');
                        $finalized_address =  $this->customerAddressRepository->create($address_data);
                    } elseif ($address_matching['status']  == 'CONFLICT') {
                        array_push($conflicted_deliveries, $row);
                        throw new Exception('Custom error message');
                    } elseif ($address_matching['status']  == 'MATCHED') {
                        $finalized_address = $address_matching['customer_db_address'];
                    }

                    echo ('<pre> Customer before $delivery_data : ' . var_dump($customer->id) . ' <pre>');

                    $delivery_data = [
                        'status' => 'UNASSIGN',
                        'is_recurring' => false,
                        'payment_status' => false,
                        'is_sign_required' => false,
                        'is_notification_enabled' => $row['notification_select_option'] == 'Yes' ? 1 : 0,
                        'note' => $row['notes'],
                        'branch_id' => $branch_id ?? null,
                        'delivery_slot_id' =>  $db_delivery_slot->id ?? null,
                        'delivery_type_id' => null,
                        'customer_id' => $customer->id,
                        'customer_address_id' => $finalized_address->id ?? null,
                    ];
                    $chunks[$key][$chunk_item_id] = $delivery_data;
                    $chunk[$chunk_item_id] = $delivery_data;
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
                echo "Headers of chunk don't match";
            }
            // $data =  $this->deliveryRepository->create($chunk[1]);
            // dd($data->id);
            $batch->add(new UploadDeliveriesCSVJob($chunk));
            // UploadDeliveriesCSVJob::dispatch($chunk);
            // DB::commit();
            // } catch (\Exception $e) {
            //     // Rollback the transaction on error
            //     DB::rollback();

            //     return 'Data upload failed: ' . $e->getMessage();
            // }
        }

        dd($chunks);



        dd();
        return $batch;
        // try {
        //     // Load the Excel file using the import class
        //     Excel::import(app(ExcelImportClass::class), $file);

        //     return redirect()->back()->with('success', 'Data successfully imported.');
        // } catch (\Exception $e) {
        //     dd($e);
        //     return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
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
        $passed_db_addresses = $parameters[1] ?? null;  // List of customer address can be passed from which passed address can be analyzed

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


        $highest_matching_address = !empty($highest_matching_address) ? $db_address_percent[0] : [];
        $result = [];
        if (empty($highest_matching_address) || $highest_matching_address['percent'] < 60) {
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
        $actual_headers = array_map(fn ($v) => trim(str_replace([' ', '(', ')'], ['_', '', ''], strtolower(preg_replace('/\(([^)]+)\)/', '$1', $v))), '_'), $actual_headers);
        $expected_headers = array_map(fn ($v) => trim(str_replace([' ', '(', ')'], ['_', '', ''], strtolower(preg_replace('/\(([^)]+)\)/', '$1', $v))), '_'), $expected_headers);

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
}
