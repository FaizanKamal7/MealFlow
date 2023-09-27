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
use Modules\DeliveryService\Entities\DeliveryTimeline;
use Modules\FinanceService\Entities\BusinessWallet;
use Illuminate\Support\Str;
use App\Helpers\TimeExtractor;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
    public function deliveryTimeline($delivery_id, $status_id, $action_by, $vehicle_id, $description)
    {
        DeliveryTimeline::create([
            'delivery_id' => $delivery_id,
            'status_id' => $status_id,
            'action_by' => $action_by,
            'vehicle_id' => $vehicle_id,
            'description' => $description,
        ]);
    }
    public function createWallet($business_id)
    {
        BusinessWallet::create([
            'balance' => 0,
            'business_id' => $business_id,
        ]);
    }

    public function deleteWallet($busines_id)
    {
        BusinessWallet::where('business_id', $busines_id)->delete;
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

        // echo "<pre> country: " . print_r($country_name, true) . "</pre>";
        // echo "<pre> state: " . print_r($state_name, true) . "</pre>";
        // echo "<pre> city: " . print_r($city_name, true) . "</pre>";

        $db_map_location_ids = [];
        if ($country_name) {

            $country_record = Country::where('name', 'LIKE', '%' . $country_name . '%')->first();

            $db_map_location_ids['country_id'] = $country_record ? $country_record->id : "";
        } else {
            $db_map_location_ids['country_id'] = "";
        }

        if ($state_name) {

            $state_record = State::where('name', 'LIKE', '%' . $state_name . '%')->first();

            $db_map_location_ids['state_id'] = $state_record ? $state_record->id : "";
        } else {
            $db_map_location_ids['state_id'] = "";
        }


        if ($city_name) {

            $city_record = City::where('name', 'LIKE', '%' . $city_name . '%')->first();

            $db_map_location_ids['city_id'] = $city_record ? $city_record->id : "";
        } else {
            $db_map_location_ids['city_id'] = "";
        }


        if ($area_name) {

            $area_record = Area::where('name', 'LIKE', '%' . $area_name . '%')->first();

            $db_map_location_ids['area_id'] = $area_record ? $area_record->id : "";
        } else {
            $db_map_location_ids['area_id'] = "";
        }


        // $this->print_array("db_map_location_ids", $db_map_location_ids);
        return $db_map_location_ids;
    }

    public function extractCitiesFromCoveragesSelection($area_coverage_list)
    {
        $cities = [];
        foreach ($area_coverage_list as $area) {
            if (isset($area["city"])) {
                foreach ($area["city"] as $city) {
                    if ($city !== null && !in_array($city, $cities)) {
                        $cities[] = $city;
                    }
                }
            }
        }
        return $cities;
    }

    function addressSimilarityPercentage($address1, $address2)
    {
        // Remove spaces and convert both addresses to lowercase
        $address1 = strtolower(str_replace(' ', '', $address1));
        $address2 = strtolower(str_replace(' ', '', $address2));

        // Calculate the Levenshtein distance between the two addresses
        $levenshteinDistance = levenshtein($address1, $address2);

        // Calculate the maximum length of the two addresses
        $maxLength = max(strlen($address1), strlen($address2));

        // Calculate the similarity percentage
        $similarityPercentage = (($maxLength - $levenshteinDistance) / $maxLength) * 100;

        return $similarityPercentage;
    }

    function concatWordsIfDoesnotExist($address, $wordsToCheck)
    {
        // Split the address into lowercase words
        $addressWords = Str::of($address)->lower()->split('/[\s,]+/');
        $tempWordsToCheck = array_map('strtolower', $wordsToCheck);
        $resultArray = [];
        foreach ($tempWordsToCheck as $str) {
            $words = explode(" ", $str);
            foreach ($words as $word) {
                $lowercaseWord = strtolower($word);
                if (!in_array($lowercaseWord, $resultArray)) {
                    $resultArray[] = $lowercaseWord;
                }
            }
        }

        // Convert the result array to lowercase
        $resultArray = array_map('strtolower', $resultArray);

        // Initialize an array to store words to concatenate
        $wordsToAdd = [];

        // Iterate through the lowercase words to check
        foreach ($resultArray as $key => $word) {

            // Check if the lowercase word is not in the address
            if (!$addressWords->contains(fn ($value) => Str::contains(Str::lower($value), $word))) {
                // Add the lowercase missing word to the list of words to concatenate
                $wordsToAdd[] = $word;
            }
        }

        // Concatenate the missing lowercase words to the address
        if (!empty($wordsToAdd)) {
            $address .= ', ' . implode(', ', $wordsToAdd);
        }

        return $address;
    }


    function convertStringAddressToCoordinates($address)
    {
        return null; // will remove it once API is acrivated
        $api_key = Config::get('services.google.key');
        $maxAttempts = 5; // Set a maximum number of attempts
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=$api_key";
            $response = file_get_contents($url);
            $response_data = json_decode($response, true);

            if ($response_data['status'] === 'OK') {
                // You got a successful response, you can process the data here if needed
                $latitude = $response_data['results'][0]['geometry']['location']['lat'];
                $longitude = $response_data['results'][0]['geometry']['location']['lng'];
                print_r("<pre> =============>>>> OK: https://maps.google.com/?q=" . $latitude . "," . $longitude . "  </pre>");
                return (object) ['latitude' => $latitude, 'longitude' => $longitude];
            }

            // If the status is not OK, reduce the address by removing text before the first comma
            $commaPosition = strpos($address, ',');
            if ($commaPosition === false) {
                // No comma found, break out of the loop
                break;
            }
            // Update the address to remove text before the first comma
            $address = substr($address, $commaPosition + 1);
            // print_r("<pre> =============>>>> UPDATED ADDRESS became" . $address . "  </pre>");
        }
        return null;
    }

    function removeExtraSpacesFromString($string)
    {
        // Remove extra spaces within the string
        $string = preg_replace('/\s+/', ' ', $string);

        // Remove spaces at the start and end of the string
        $string = trim($string);
        return $string;
    }

    function extractDeliverySlotFromCityWithTime($cityWithTime)
    {
        // Use regular expressions to extract the start and end times
        $pattern = '/\((\d{2}:\d{2}) - (\d{2}:\d{2})\)/';

        preg_match($pattern, $cityWithTime, $matches);

        if (count($matches) === 3) {
            // Create an object with start_time and end_time properties
            $result = new \stdClass();
            $result->start_time = $matches[1];
            $result->end_time = $matches[2];

            return $result;
        }
        return null;
    }

    function getExcelSheetData($file)
    {
        $spreadsheet = IOFactory::load($file->getPathname());

        // Get data from the first sheet
        $sheet = $spreadsheet->getSheet(0); // 0 is the index of the first sheet
        $data = $sheet->toArray();

        // Remove empty rows from the end of the array
        $data = array_filter($data, function ($row) {
            return !empty(array_filter($row));
        });

        // Reset array keys
        $data = array_values($data);
        return $data;
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
