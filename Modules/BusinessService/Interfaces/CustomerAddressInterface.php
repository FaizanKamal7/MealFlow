<?php

namespace Modules\BusinessService\Interfaces;

interface CustomerAddressInterface
{
    public function get();
    public function create($data);
    public function getCustomerAddresses($customer_id);
    public function getCustomerCityAddresses($customer_id, $city_id);
    public function getCustomerAddressesbyID($address_id);
    public function getCustomerAddressById($id);


}
