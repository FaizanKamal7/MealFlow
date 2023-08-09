<?php

namespace Modules\BusinessService\Http\Controllers\BusinessPricing;

use App\Interfaces\CountryInterface;
use App\Interfaces\DeliverySlotInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\BusinessService\Interfaces\BusinessPricingInterface;
use Modules\BusinessService\Interfaces\DeliverySlotPricingInterface;
use Modules\BusinessService\Interfaces\RangePricingInterface;
use Modules\BusinessService\Interfaces\PricingTypeInterface;

class BusinessPricingController extends Controller
{

    private DeliverySlotInterface $deliverySlotRepository;
    private CountryInterface $countryRepository;
    private BusinessPricingInterface $businessPricingRepository;
    private RangePricingInterface $rangePricingRepository;
    private PricingTypeInterface $pricingTypeRepository;
    private DeliverySlotPricingInterface $deliverySlotPricingRepository;
    private BusinessInterface $businessRepository;




    public function __construct(DeliverySlotInterface $deliverySlotRepository, CountryInterface $countryRepository, BusinessPricingInterface $businessPricingRepository, RangePricingInterface $rangePricingRepository, PricingTypeInterface $pricingTypeRepository, DeliverySlotPricingInterface $deliverySlotPricingRepository, BusinessInterface $businessRepository)
    {
        $this->deliverySlotRepository = $deliverySlotRepository;
        $this->countryRepository = $countryRepository;
        $this->businessPricingRepository = $businessPricingRepository;
        $this->rangePricingRepository = $rangePricingRepository;
        $this->pricingTypeRepository = $pricingTypeRepository;
        $this->deliverySlotPricingRepository = $deliverySlotPricingRepository;
        $this->businessRepository = $businessRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function deliverySlotBasePricing()
    {
        $delivery_slot_pricings = $this->deliverySlotPricingRepository->get();
        return view('businessservice::pricing.delivery_slot_wise_base_pricing', ['delivery_slot_pricings' => $delivery_slot_pricings]);
    }

    public function rangeBasePricing()
    {
        $pricings = $this->rangePricingRepository->get();
        return view('businessservice::pricing.range_wise_base_pricing', ['pricings' => $pricings]);
    }



    public function addDeliverySlotBasePricing()
    {
        $delivery_slots = $this->deliverySlotRepository->getAllDeliverySlots();
        $countries = $this->countryRepository->getAllActiveCountries();
        $businesses = $this->businessRepository->getActiveBusinesses();

        return view('businessservice::pricing.add_delivery_slot_base_pricing', ['delivery_slots' => $delivery_slots, 'countries' => $countries, 'businesses' => $businesses]);
    }

    public function addRangeBasePricing()
    {
        $delivery_slots = $this->deliverySlotRepository->getAllDeliverySlots();
        $countries = $this->countryRepository->getAllActiveCountries();
        $businesses = $this->businessRepository->getActiveBusinesses();

        return view('businessservice::pricing.add_range_base_pricing', ['delivery_slots' => $delivery_slots, 'countries' => $countries, 'businesses' => $businesses]);
    }


    public function getDeliverySlotsOfCityInBasePrice(Request $request)
    {
        $cities = $request->cities;

        // -- First character is a comma and then remove it 
        $cities = $cities[0] == ',' ? substr($cities, 1) : $cities;
        $cities_arr = explode(",", $cities);
        $delivery_slots = $this->deliverySlotRepository->getAllDeliverySlotsOfCities($cities_arr);
        $final_delivery_slot = [];
        foreach ($delivery_slots as $key => $value) {
            array_push($final_delivery_slot, [$value['id'], $value['start_time'] . "-" . $value['end_time']]);
        }
        return response()->json($final_delivery_slot);
    }

    public function getCityRangeBasePrice(Request $request)
    {
        echo ("Inside getCityRangeBasePrice");

        $cities = $request->cities;
        $cities = $cities[0] == ',' ? substr($cities, 1) : $cities;
        $cities_arr = explode(",", $cities);
        $range_pricing = $this->rangePricingRepository->getAllRangeBasePricesOfCities($cities_arr);
        return response()->json($range_pricing);
    }

    public function getCitiesRangeBusinessPrice(Request $request)
    {
        $cities = $request->cities;
        $business_id = $request->business_id;
        $cities = $cities[0] == ',' ? substr($cities, 1) : $cities;
        $cities_arr = explode(",", $cities);
        $range_pricing = $this->rangePricingRepository->getAllRangeBusinessPricesOfCities($cities_arr, $business_id);
        dd($range_pricing);
        return response()->json($range_pricing);
    }

    public function storeCityRangeBasePrice(Request $request)
    {
        $range_pricing_list = $request->range_pricing_list;
        $cities = json_decode($request->cities);
        $business_id = $request->business_id;

        $all_cities_pricing = $this->rangePricingRepository->getAllRangeBasePricesOfCities($cities);
        $all_cities_pricing =  $all_cities_pricing->map(function ($data) {
            return $data->attributesToArray();
        })->toArray();

        foreach ($cities as $key => $city) {
            foreach ($range_pricing_list as $key => $range_pricing) {

                // -- For existing ranges, update the data
                if (array_key_exists("available_base_range_pricing_id", $range_pricing)) {
                    echo '<pre> O L D ' . var_export($range_pricing, true) . '</pre>';
                    $is_same_for_all_services = $this->isSameForAllServices($range_pricing);

                    $data = [
                        'min_range' => $range_pricing['min_range'],
                        'max_range' => $range_pricing['max_range'],
                        'delivery_price' => $range_pricing['delivery_price'],
                        'bag_collection_price' => $range_pricing['bag_collection_price'],
                        'cash_collection_price' => $range_pricing['cash_collection_price'],
                        'same_loc_delivery_price' => $range_pricing['same_loc_delivery_price'],
                        'same_loc_bag_collection_price' => $range_pricing['same_loc_bag_collection_price'],
                        'same_loc_cash_collection_price' => $range_pricing['same_loc_cash_collection_price'],
                        'is_same_for_all_services' => $is_same_for_all_services,
                    ];
                    $this->rangePricingRepository->update($range_pricing['available_base_range_pricing_id'], $data);

                    // -- For new ranges, add new data
                } else if ($range_pricing['is_same_price'] ==  "true" || $range_pricing['is_same_price'] == NULL) {
                    echo '<pre> S A M E </pre>';
                    echo '<pre> new_pricing_data : ' . var_export($range_pricing, true) . '</pre>';

                    $data = [
                        'min_range' => $range_pricing['same_min_range'],
                        'max_range' => $range_pricing['same_max_range'],
                        'delivery_price' => $range_pricing['price'],
                        'bag_collection_price' => $range_pricing['price'],
                        'cash_collection_price' => $range_pricing['price'],
                        'same_loc_delivery_price' => $range_pricing['same_loc_price'],
                        'same_loc_bag_collection_price' => $range_pricing['same_loc_price'],
                        'same_loc_cash_collection_price' => $range_pricing['same_loc_price'],
                        'is_same_for_all_services' => true,
                        'city_id' => $city,
                        'business_id' => $business_id,

                    ];
                    $added_pricing = $this->rangePricingRepository->create($data);
                } else {
                    echo '<pre> D I F F E R E N T </pre>';
                    echo '<pre> new_pricing_data : ' . var_export($range_pricing, true) . '</pre>';

                    $data = [
                        'min_range' => $range_pricing['min_range'],
                        'max_range' => $range_pricing['max_range'],
                        'delivery_price' => $range_pricing['delivery_price'],
                        'bag_collection_price' => $range_pricing['bag_collection_price'],
                        'cash_collection_price' => $range_pricing['cash_collection_price'],
                        'same_loc_delivery_price' => $range_pricing['same_loc_delivery_price'],
                        'same_loc_bag_collection_price' => $range_pricing['same_loc_bag_collection_price'],
                        'same_loc_cash_collection_price' => $range_pricing['same_loc_cash_collection_price'],
                        'is_same_for_all_services' => false,
                        'city_id' => $city,
                        'business_id' => $business_id,

                    ];
                    $added_pricing =  $this->rangePricingRepository->create($data);
                }
            }
        }


        return redirect()->back()->with("success", "Daily Range pricing added successfully");
    }

    public function storeDeliverySlotPricingInBasePrice(Request $request)
    {
        $cities = json_decode($request->cities);
        $delivery_slot_pricing = $request->all();
        $business_id = $request->business_id;

        $cities_delivery_slot_pricing = $request->input('cities_delivery_slot');
        foreach ($cities as $key => $city) {
            foreach ($cities_delivery_slot_pricing as $index => $delivery_slot_pricing) {
                if ($delivery_slot_pricing['is_same_price'] == "true") {
                    $data = [
                        'delivery_price' => $delivery_slot_pricing['price'],
                        'bag_collection_price' => $delivery_slot_pricing['price'],
                        'cash_collection_price' => $delivery_slot_pricing['price'],
                        'same_loc_delivery_price' => $delivery_slot_pricing['same_loc_price'],
                        'same_loc_bag_collection_price' => $delivery_slot_pricing['same_loc_price'],
                        'same_loc_cash_collection_price' => $delivery_slot_pricing['same_loc_price'],
                        'delivery_slot_id' => $delivery_slot_pricing['delivery_slot_id'],
                        'is_same_for_all_services' => true,
                        'city_id' => $city,
                        'business_id' => $business_id,
                    ];
                    // echo '<pre> S A M E </pre>';
                    // echo '<pre> new_pricing_data : ' . var_export($data, true) . '</pre>';

                    $this->deliverySlotPricingRepository->create($data);
                } else {
                    $data = [
                        'delivery_price' => $delivery_slot_pricing['delivery_price'],
                        'bag_collection_price' => $delivery_slot_pricing['bag_collection_price'],
                        'cash_collection_price' => $delivery_slot_pricing['cash_collection_price'],
                        'same_loc_delivery_price' => $delivery_slot_pricing['same_loc_delivery_price'],
                        'same_loc_bag_collection_price' => $delivery_slot_pricing['same_loc_bag_collection_price'],
                        'same_loc_cash_collection_price' => $delivery_slot_pricing['same_loc_cash_collection_price'],
                        'delivery_slot_id' => $delivery_slot_pricing['delivery_slot_id'],
                        'is_same_for_all_services' => false,
                        'city_id' => $city,
                        'business_id' => $business_id,
                    ];
                    // echo '<pre> D I F F </pre>';
                    // echo '<pre> new_pricing_data : ' . var_export($data, true) . '</pre>';

                    $this->deliverySlotPricingRepository->create($data);
                }
            }
        }
        return redirect()->back()->with("success", "Delivery Slot pricing added successfully");
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('businessservice::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('businessservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('businessservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */

    // TODO: Add below in helper
    public function dbObjectToArray($obj_data)
    {
        return $obj_data->map(function ($data) {
            return $data->attributesToArray();
        })->toArray();
    }

    public function isSameForAllServices($range_pricing)
    {
        if (
            $range_pricing['cash_collection_price'] == $range_pricing['delivery_price']
            && $range_pricing['delivery_price'] == $range_pricing['bag_collection_price']
            && $range_pricing['same_loc_cash_collection_price'] == $range_pricing['same_loc_bag_collection_price']
            && $range_pricing['same_loc_bag_collection_price'] == $range_pricing['same_loc_delivery_price']

        ) {

            return true;
        } else {
            return false;
        }
    }
}












  // $deliveryPrices = [];
        // $delivery_slot_prices = [];
        // $same_location_prices = [];
        // $delivery_slots = $request->delivery_slots;
        // $cities = $request->cities;
        // $pricing_types  =  $this->pricingTypeRepository->getPricingTypes();

        // // Loop over all request parameters
        // foreach ($request->all() as $key => $value) {
        //     // Match 'delivery_slot_price' followed by any number
        //     if (preg_match('/delivery_slot_price[0-9]+/', $key)) {
        //         $delivery_slot_prices[] = $value;
        //     }
        //     // Match 'sameLocationPrice' followed by any number
        //     if (preg_match('/sameLocationPrice[0-9]+/', $key)) {
        //         $same_location_prices[] = $value;
        //     }
        // }


        // $pricing_all = [];
        // $cities = $cities[0] == ',' ? substr($cities, 1) : $cities;
        // $cities_arr = explode(",", $cities);

        // $delivery_slots = rtrim($delivery_slots[0] == ',' ? substr($delivery_slots, 1) : $delivery_slots, ",");
        // $delivery_slots_arr = explode(",", $delivery_slots);

        // foreach ($cities_arr as $index => $city) {
        //     // Get the attributes for the current city
        //     $delivery_slot_price = $delivery_slot_prices[$index];
        //     $same_location_price = $same_location_prices[$index];
        //     foreach ($delivery_slots_arr as $key => $delivery_slot_id) {

        //         if (count($pricing_types) > 1) {
        //             foreach ($pricing_types as $key => $pricing_type) {
        //                 echo '<pre>pricing_all: ' . var_export($delivery_slot_id, true) . '</pre>';

        //                 // Create a new row array with the attributes
        //                 $pricing = [
        //                     'delivery_slot_price' => $delivery_slot_price,
        //                     'same_loc_delivery_slot_price' => $same_location_price,
        //                     'delivery_slot_id' => $delivery_slot_id,
        //                     'active_status' => 1,
        //                     'city_id' => $city,
        //                     'pricing_type_id' => $pricing_type->id,

        //                 ];
        //                 $added_pricing =  $this->rangePricingRepository->create($pricing);
        //                 array_push($pricing_all, $added_pricing);
        //             }
        //         } else {

        //             $pricing = [
        //                 'delivery_slot_price' => $delivery_slot_price,
        //                 'same_loc_delivery_slot_price' => $same_location_price,
        //                 'delivery_slot_id' => $delivery_slot_id,
        //                 'active_status' => 1,
        //                 'city_id' => $city,
        //                 'pricing_type_id' => null,

        //             ];
        //             $added_pricing =  $this->rangePricingRepository->create($pricing);
        //             array_push($pricing_all, $added_pricing);
        //         }
        //     }
        // }
        // foreach ($pricing_all as $key => $added_pricing) {
        //     $business_pricing = [
        //         'pricing_id' => $added_pricing->id,
        //         'business_id' => null,
        //         'delivery_slot_id' => $delivery_slot_id,
        //         'active_status' => 1,
        //         'city_id' => $city,
        //         'pricing_type_id' => $pricing_type->id,

        //     ];
        //     $this->businessPricingRepository->create($business_pricing);
        // }