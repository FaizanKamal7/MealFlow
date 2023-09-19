<?php

namespace Modules\DeliveryService\Http\Controllers\Deliveries;

use App\Http\Helper\Helper;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\DeliverySlotInterface;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\BusinessService\Entities\Customer;
use Modules\BusinessService\Entities\CustomerAddress;
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;
use Modules\BusinessService\Interfaces\CustomerInterface;
use Modules\DeliveryService\Http\Exports\DeliveryTemplateClass;
use Modules\DeliveryService\Http\Exports\ExcelImportClass;
use Modules\DeliveryService\Jobs\UploadDeliveriesCSV;
use Modules\DeliveryService\Jobs\UploadDeliveriesCSVJob;

class DeliveryController extends Controller
{
    private $customerRepository;
    private $cityRepository;
    private $areaRepository;
    private $customerAddressRepository;
    private $deliverySlotRepository;
    private $helper;

    public function __construct(
        CustomerInterface $customerRepository,
        CityInterface $cityRepository,
        AreaInterface $areaRepository,
        CustomerAddressInterface $customerAddressRepository,
        DeliverySlotInterface $deliverySlotRepository,
        Helper $helper,
    ) {
        $this->customerRepository = $customerRepository;
        $this->cityRepository = $cityRepository;
        $this->areaRepository = $areaRepository;
        $this->customerAddressRepository = $customerAddressRepository;
        $this->deliverySlotRepository = $deliverySlotRepository;
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
        return view('deliveryservice::deliveries.upload_delivery');
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
            'address',
            'area_with_city_select_option',
            'customerid_optional',
            'email_optional',
            'city_with_time_select_option',
            'full_name',
            'google_link_address_optional',
            'notes',
            'notification_select_option',
            'phone',
            'pickup_point_optional',
            'product_type_optional'
        ];
        $file = $request->file('excel_file');
        // Import and process the Excel data
        $data = Excel::toArray(new ExcelImportClass, $file);

        // Create chunks of data with 10 rows each
        $chunks = array_chunk($data[0], 10);

        $header = [];
        $batch  = Bus::batch([])->dispatch();
        DB::beginTransaction();


        foreach ($chunks as $key => $chunk) {
            try {
                $header = array_keys($chunk[0]);

                if ($this->headersMatch($header, $expected_headers)) {
                    foreach ($chunk as $key => $row) {
                        // ---- 1. Check if the user with the phone no eist in the DB
                        // $customer_db_id = Customer::with('user')->where(['phone' => $row['phone']])->get();
                        $customer = $this->customerRepository->customerWithMatchingPhoneNoInUsers($row['phone']);
                        // 1) --- Check if sheet phone is in users DB table (primary number) then match DB name with sheet name 
                        //      1.1) --- If 1 true, customer uniquily identified ( S U C C E S S )
                        //      1.2) --- If 1 false, check sheet number is in customers secondary numbers DB table 
                        //          1.2.1) --- If 1.2 true, then check corresponding customer DB name matches with users DB table 
                        //              1.2.1.1) --- If 1.2.1 true, then get uniquily identified customer ( S U C C E S S )
                        //              1.2.1.2) --- If 1.2.1 false, then fetch the addresses of DB customer and check if it match sheet address
                        //                  1.2.1.2.1) --- If 1.2.1.2 true, then get uniquily identified customer ( S U C C E S S ) 
                        //                  1.2.1.2.2) --- If 1.2.1.2 false, give the option for manual review ( R E V I E W ) 
                        //          1.2.2) --- If 1.2 false, then add new customer ( S U C C E S S )


                        // if ($customer->name ==) {
                        //     # code...
                        // }

                        $sheet_area_with_city = $row['area_with_city_select_option'];
                        $city_name = '';
                        $area_name = '';
                        $tag = '';
                        $need_manual_verfication = false;
                        $new_address_coordinates = [];
                        $db_address_percent = [];
                        print_r("<pre> customer_db_id: " . print_r($customer->id, true) . "</pre>");
                        print_r("<pre> sheet_area_with_city: " . print_r($sheet_area_with_city, true) . "</pre>");
                        print_r("<pre> DB NAME: " . print_r($customer->user->name, true) . "</pre>");
                        print_r("<pre> SHEET NAME: " . print_r($row['full_name'], true) . "</pre>");



                        $openingParenthesisPos = strpos($sheet_area_with_city, '(');

                        // ---- 2. Get the sheet area name with city and extract DB ID
                        if ($openingParenthesisPos !== false) {
                            $city_name = substr($sheet_area_with_city, 0, $openingParenthesisPos);
                            $area_name = substr($sheet_area_with_city, $openingParenthesisPos + 1, -1);
                        }
                        print_r("<pre> city: '" . print_r($city_name, true) . "'</pre>");
                        print_r("<pre> area: " . print_r($area_name, true) . "</pre>");

                        $city = $this->cityRepository->searchCityFirst($this->helper->removeExtraSpacesFromString($city_name));
                        $area = $this->areaRepository->searchAreaFirst($this->helper->removeExtraSpacesFromString($area_name));
                        print_r("<pre> city: '" . print_r($city->id, true) . "'</pre>");
                        print_r("<pre> area: " . print_r($area->id, true) . "</pre>");

                        // ---- 3. Get all the addresses ($customer_address) of the db customer of selected city
                        $sheet_address = $row['address'];
                        $customer_addresses = $this->customerAddressRepository->getCustomerCityAddresses($customer->id, $city->id);
                        // $customer_address = CustomerAddress::where(['customer_id' => $customer, 'city_id' => $city->id, 'state_id' => $area->id])->get();
                        print_r("<pre> ---- sheet_address: " . print_r($sheet_address, true) . "</pre>");


                        $conflicted_db_address = "";

                        // ---- 4. Match the sheet address with $customer_address in db and calculate the percent
                        foreach ($customer_addresses as $customer_address) {
                            print_r("<pre> customer_address: " . print_r($customer_address->address, true) . "</pre>");
                            // Adding state and country if not already exist
                            $temp_sheet_address = $this->helper->concatWordsIfDoesnotExist($sheet_address, [$customer_address->city->name, $customer_address->state->name, $customer_address->country->name]);
                            $temp_customer_address = $this->helper->concatWordsIfDoesnotExist($customer_address->address, [$customer_address->city->name, $customer_address->state->name, $customer_address->country->name]);

                            $similarity = $this->helper->addressSimilarityPercentage($temp_customer_address, $temp_sheet_address);
                            print_r("<pre> similarity: " . print_r($similarity, true) . " % </pre>");
                            // Add the new item to the array
                            array_push($db_address_percent, ['percent' => $similarity, 'address' => $customer_address->address]);

                            // Custom sorting function to sort by "percent" in descending order
                            usort($db_address_percent, function ($a, $b) {
                                return $b['percent'] - $a['percent'];
                            });
                        }


                        $highest_matching_address = $db_address_percent[0];
                        print_r("<pre> highest_matching_address: " . print_r($highest_matching_address, true) . " </pre>");

                        if ($highest_matching_address['percent'] == 100) {
                            // ---- 4.1. Check if highest matching address is exctly the same 

                        } elseif ($similarity > 60) {
                            // ---- 4.2. Check if highest matching address match percent is more than 60% then prompt the user to choose address manually

                            $conflicted_db_address = $customer_address;
                        } else {

                            // ---- 4.3. Check if highest matching address match percent is less than 60%. Mean doesn't exist in db
                            $new_address_coordinates = $this->helper->convertStringAddressToCoordinates($sheet_address);
                            print_r("<pre> new_address_coordinates: " . print_r($new_address_coordinates, true) . " </pre>");

                            if ($new_address_coordinates == null) {
                                $tag = "No coordinates available";
                            } else {
                                $tag = "Manual apporval required";

                                $data = [
                                    'address' =>  $sheet_address,
                                    'address_type' =>  "OTHER",
                                    'latitude' =>  $new_address_coordinates->latitude,
                                    'longitude' =>  $new_address_coordinates->longitude,
                                    'customer_id' =>  $customer->id,
                                    'area_id' =>  $area->id,
                                    'city_id' =>  $city->id,
                                    'state_id' =>  $city->state->id,
                                    'country_id' =>  $city->state->country->id,
                                ];
                                // $this->customerAddressRepository->create($data);
                            }
                            // $timeObject = TimeExtractor::extractTime($inputString);

                            $delivery_slot = $this->helper->extractDeliverySlotFromCityWithTime($row['city_with_time_select_option']);
                            $delivery_slot = $this->deliverySlotRepository->getDeliverySlotsByTimeAndCity($delivery_slot->start_time, $delivery_slot->end_time, $city->id);
                        }

                        $delivery_data = [
                            'status' => 'unassigned',
                            'is_recurring' => false,
                            'payment_status' => 'paid',
                            'is_sign_required' => false,
                            'note' => 'NA',
                            'branch_id' => 'vendor user_id',
                            'delivery_slot_id' => $delivery_slot->id ?? null,
                            'delivery_type_id' => 'Food',
                            'customer_id' =>   $customer->id,
                            'customer_address_id' => $customer_address->id,

                        ];
                        $chunk[$key] = $delivery_data;
                    }
                } else {
                    echo "Headers of chunk don't match";
                }


                // $batch->add(new UploadDeliveriesCSVJob($chunk, $header));
                UploadDeliveriesCSVJob::dispatch(
                    $chunk,
                    $header,
                );
            } catch (\Exception $e) {
                // Rollback the transaction on error
                DB::rollback();

                return 'Data upload failed: ' . $e->getMessage();
            }
        }


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
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     */
    public function show($id)
    {
        return view('deliveryservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function edit($id)
    {
        return view('deliveryservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy($id)
    {
        //
    }

    //TODO::This function (getAddresses) will be moved to CustomerAddressController

    public function getAddresses(Request $request)
    {
        $selectedCustomer = $request->input('customer');
        // Retrieve delivery addresses for the selected customer
        $deliveryAddresses = CustomerAddress::where('customer', $selectedCustomer)->pluck('address');

        return response()->json(['deliveryAddresses' => $deliveryAddresses]);
    }

    protected function headersMatch($actualHeaders, $expected_headers)
    {

        // $actualHeaders = array_keys($actualHeaders);
        $actualHeadersLowercase = array_map('strtolower', $actualHeaders);
        $expected_headersLowercase = array_map('strtolower', $expected_headers);

        sort($actualHeadersLowercase);
        sort($expected_headersLowercase);
        echo '<pre>';
        print_r($actualHeadersLowercase);
        echo '<pre>';
        echo '<pre>';
        print_r($expected_headersLowercase);
        echo '<pre>';

        return $actualHeadersLowercase === $expected_headersLowercase;
    }
}
