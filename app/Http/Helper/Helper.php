<?php

namespace App\Http\Helper;

use App\Models\ActivityLogs;
use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\Config;
use Modules\CRM\Entities\Task;
use Modules\DeliveryService\Entities\BagTimeline;

class Helper
{
    public function logActivity($userId, $moduleName, $action, $subject, $url, $description, $ipAddress, $userAgent, $oldValues, $newValues, $recordId, $recordType, $method)
    {
        ActivityLogs::create([
            'user_id' => $userId,
            'module_name' => $moduleName,
            'action' => $action,
            'subject' => $subject,
            'url' => $url,
            'description' => $description,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'record_id' => $recordId,
            'record_type' => $recordType,
            'method' => $method,
        ]);
    }

    public function bagTimeline($bag_id, $delivery_id, $status_id, $action_by, $vehicle_id, $description)
    {
        BagTimeline::create([
            'bag_id' => $bag_id,
            'delivery_id' => $delivery_id,
            'status_id' => $status_id,
            'action_by' => $action_by,
            'vehicle_id' => $vehicle_id,
            'description' => $description,
        ]);
    }


    function getLocationFromCoordinates($latitude, $longitude)
    {
        $api_key = Config::get('services.google.key');
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=$api_key&language_code=en"; // Add &language=en
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        $country = $state = $city = $area = '';

        if ($data && isset($data['results'][1])) {
            foreach ($data['results'][1]['address_components'] as $component) {
                $types = $component['types'];
                if (in_array('country', $types)) {
                    $country = $component['long_name'];
                } elseif (in_array('administrative_area_level_1', $types)) {
                    $state = $component['long_name'];
                } elseif (in_array('locality', $types)) {
                    $city = $component['long_name'];
                } elseif (in_array('sublocality_level_1', $types) || in_array('neighborhood', $types)) {
                    $area = $component['long_name'];
                }
            }
        }

        return array(
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'area' => $area
        );
    }


    function findDBLocationsWithNames(...$parameters)
    {
        // $parameters is now an array containing all the passed arguments
        $country_name = $parameters[0] ?? null;
        $state_name = $parameters[1] ?? null;
        $city_name = $parameters[2] ?? null;
        $area_name = $parameters[3] ?? null;

        echo "<pre> country: " . print_r($country_name, true) . "</pre>";
        echo "<pre> state: " . print_r($state_name, true) . "</pre>";
        echo "<pre> city: " . print_r($city_name, true) . "</pre>";

        $db_map_location_ids = [];
        if ($country_name) {
            $country_record = Country::where('name', $country_name)->first();
            $db_map_location_ids['country_id'] = $country_record ? $country_record->id : "";
        } else {
            $db_map_location_ids['country_id'] = "";
        }

        if ($state_name) {
            $state_record = State::where('name', $state_name)->first();
            $db_map_location_ids['state_id'] = $state_record ? $state_record->id : "";
        } else {
            $db_map_location_ids['state_id'] = "";
        }


        if ($city_name) {
            $city_record = City::where('name', $city_name)->first();
            $db_map_location_ids['city_id'] = $city_record ? $city_record->id : "";
        } else {
            $db_map_location_ids['city_id'] = "";
        }


        if ($area_name) {
            $area_record = Area::where('name', $area_name)->first();
            $db_map_location_ids['area_id'] = $area_record ? $area_record->id : "";
        } else {
            $db_map_location_ids['area_id'] = "";
        }

        $this->print_array("db_map_location_ids", $db_map_location_ids);
        return $db_map_location_ids;
    }


    function print_array($title, $array)
    {

        if (is_array($array)) {

            echo $title . "<br/>" .
                "||---------------------------------||<br/>" .
                "<pre>";
            print_r($array);
            echo "</pre>" .
                "END " . $title . "<br/>" .
                "||---------------------------------||<br/>";
        } else {
            echo $title . " is not an array.";
        }
    }
}
