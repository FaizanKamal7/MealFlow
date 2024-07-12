<?php

namespace App\Http\Controllers\Admin\DeliverySlots;

use App\Http\Controllers\Controller;
use App\Interfaces\CountryInterface;
use App\Interfaces\DeliverySlotInterface;
use Illuminate\Http\Request;

class DeliverySlotController extends Controller
{

    private DeliverySlotInterface $deliverySlotRepository;
    private CountryInterface $countryRepository;

    public function __construct(DeliverySlotInterface $deliverySlotRepository, CountryInterface $countryRepository)
    {
        $this->deliverySlotRepository = $deliverySlotRepository;
        $this->countryRepository = $countryRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivery_slots = $this->deliverySlotRepository->getAllDeliverySlots();
        $countries = $this->countryRepository->getAllActiveCountries();

        return view('admin.delivery_slots.delivery_slots', ['delivery_slots' => $delivery_slots, 'countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addDeliverySlotView()
    {
        $delivery_slots = $this->deliverySlotRepository->getAllDeliverySlots();
        $countries = $this->countryRepository->getAllActiveCountries();

        return view('admin.delivery_slots.add_delivery_slot', ['delivery_slots' => $delivery_slots, 'countries' => $countries]);
    }

    public function storeDeliverySlots(Request $request)
    {

        $delivery_slots_list = $request->delivery_slots_list;
        $end_time = $request->end_time;
        $country = $request->country;
        $state = $request->state;
        $cities = $request->cities;

        // echo '<pre>' . var_export($delivery_slots_list, true) . '</pre>';

        // -- First character is a comma and then remove it 
        $cities = $cities[0] == ',' ? substr($cities, 1) : $cities;
        $cities_arr = explode(",", $cities);

        // TODO: Validator for data
        // echo '<pre>' . var_export($cities_arr, true) . '</pre>';

        foreach ($cities_arr as $key => $city) {
            foreach ($delivery_slots_list as $key => $delivery_slot) {
                $start_time = date("H:i", strtotime($delivery_slot['start_time']));
                $end_time = date("H:i", strtotime($delivery_slot['end_time']));
                $this->deliverySlotRepository->addDeliverySlots($start_time, $end_time, $city);
            }
        }

        return redirect()->route("get_all_delivery_slots")->with("success", "Delivery Slot added successfully");
    }


    public function getDeliverySlotsOfCity(Request $request)
    {
        $delivery_slots = $this->deliverySlotRepository->getAllDeliverySlotsOfCity($request->city_id);
        return response()->json($delivery_slots->toArray());
    }
}
