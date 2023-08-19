<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\BusinessPricing;
use Modules\BusinessService\Entities\RangePricing;
use Modules\BusinessService\Interfaces\RangePricingInterface;

class RangePricingRepository implements RangePricingInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function get()
    {
        return RangePricing::all();
    }

    public function create($data)
    {
        return RangePricing::create($data);
    }

    public function update($id, $data)
    {
        return RangePricing::where('id', $id)->update($data);
    }

    public function updateOrCreatePricing($data)
    {
        return RangePricing::updateOrCreate($data);
    }

    public function getAllRangeBasePricesOfCities($cities)
    {

        return RangePricing::whereIn('city_id', $cities)
            ->where('active_status', 1)
            ->get();
    }

    public function getAllRangeBusinessPricesOfCities($cities, $business_id)
    {
        $business_id = $business_id == "" ? null : $business_id;
        return RangePricing::whereIn('city_id', $cities)
            ->where('active_status', 1)
            ->where('business_id', $business_id)
            ->get();
    }


    public function getAllRangeBasePricesOfCity($city)
    {
        return RangePricing::where('city_id', $city)
            ->where('active_status', 1)
            ->get();
    }


    // public function getAllRangeBasePricesOfCity($city)
    // {
    //     return RangePricing::with('city_id', 'min_range', 'max_range', 'range_price', 'active_status', 'same_loc_range_price', 'pricing_type_id')
    //         ->where('city_id', $city)
    //         ->where('active_status', 1)
    //         ->get();
    // }
}
