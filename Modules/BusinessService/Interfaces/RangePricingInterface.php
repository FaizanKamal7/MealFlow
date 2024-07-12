<?php

namespace Modules\BusinessService\Interfaces;

interface RangePricingInterface
{
    public function get();
    public function create($data);
    public function update($id, $data);
    public function getAllRangeBasePricesOfCities($cities);
    public function getAllRangeBasePricesOfCity($city);
    public function getAllRangeBusinessPricesOfCities($cities, $business_id);
    public function getBusinessPricing($business_id);
    public function getRangePriceOfDelivery($delivery_count, $city_id, $business_id = null);
}
