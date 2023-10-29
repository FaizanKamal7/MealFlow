<?php

namespace App\Http\Controllers\Admin\LocationManagement\Area;

use App\Http\Controllers\Controller;
use App\Http\Helper\Helper;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\CountryInterface;
use App\Interfaces\StateInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class AreaController extends Controller
{

    private AreaInterface $areaRepository;
    private CityInterface $cityRepository;
    private StateInterface $stateRepository;
    private CountryInterface $countryRepository;
    private $helper;


    public function __construct(AreaInterface $areaRepository, CityInterface $cityRepository, StateInterface $stateRepository, CountryInterface $countryRepository, Helper $helper)
    {
        $this->areaRepository = $areaRepository;
        $this->cityRepository = $cityRepository;
        $this->stateRepository = $stateRepository;
        $this->countryRepository = $countryRepository;
        $this->helper = $helper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAreasOfCity(Request $request)
    {
        // dd($request->city_id);
        $areas = [];
        if ($request) {
            $areas = $this->areaRepository->getAreasOfCity($request->city_id);
        }
        return response()->json($areas->toArray());
    }


    public function extractAreasOfCityFromAPI($city_id, $city_name)
    {
        $city = $this->cityRepository->get($city_id);
        $city_name = str_replace(' ', '%20', $city_name);
        $user_name = "faizankamal_";
        $maxRows = 200;
        $featureCode_1 = 'PPLX';
        $featureCode_2 = 'PPL';

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'http://api.geonames.org/search?q=' . $city_name . '&maxRows=' . $maxRows . '&username=' . $user_name . '&featureCode=' . $featureCode_1 . '&featureCode=' . $featureCode_2,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            )
        );
        $response = curl_exec($curl);

        curl_close($curl);
        $responce = simplexml_load_string($response);

        $responce = json_encode($responce);
        $areas_array = json_decode($responce, true);


        // Removed elements with duplicated names
        $areas_unique_name_array = $this->helper->removeArrayDuplicatesWithProperty(
            array: $areas_array['totalResultsCount'] != 0 ? $areas_array['geoname'] : '',
            property_name: 'name'
        );

        // Re-index the array if needed
        $api_areas_object = (object) $areas_unique_name_array;
        return View::make("admin.locations.city_location_activation", ['areas' => $api_areas_object, 'selected_city_id' => $city_id, 'city' => $city]);
    }


    public function activateCityAreas(Request $request)
    {
        $selected_areas = $request->input('areas');
        $city_id = $request->input('city_id');

        $city = $this->cityRepository->get($city_id);

        if ($selected_areas) {
            foreach ($selected_areas as $area) {
                $area_object = json_decode($area);
                $area_geoname_exist = $this->areaRepository->getWhereSingle([['geoname_id', $area_object->geonameId]]);

                if ($area_geoname_exist == null) {

                    $coordinates = $area_object->lat . "," . $area_object->lng;

                    $single_area =
                        [
                            'active_status' => 1,
                            'name' => $area_object->name,
                            'city_id' => $city_id,
                            'geoname_id' => $area_object->geonameId,
                            'coordinates' => $coordinates,

                        ];
                    $this->areaRepository->add($single_area);
                }
            }
        } else {
            $coordinates = $city->latitude . "," . $city->longitude;

            $single_area =
                [
                    'active_status' => 1,
                    'name' => $city->name,
                    'city_id' => $city_id,
                    'coordinates' => $coordinates,
                ];

            $this->areaRepository->updateOrInsertAreaIfAttributeExist(
                attribute: "name",
                value: $city->name,
                data: $single_area
            );
        }
        $this->cityRepository->update($city_id, ['active_status' => true]);
        $this->stateRepository->update($city->state_id, ['active_status' => true]);
        $this->countryRepository->update($city->state->country_id, ['active_status' => true]);
        return redirect()->route('activate_locations_view')->with('success', 'Areas activated successfully');
    }
}
