<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\CustomerAddress;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;

class CustomerAddressRepository implements CustomerAddressInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function get()
    {
        return CustomerAddress::with('customer')->get();
    }

    public function create($data)
    {
        return CustomerAddress::create($data);
    }

    public function getCustomerAddressById($id)
    {
        // return Area::where($id)->get();
        return CustomerAddress::find($id);

    }
    public function getCustomerCityAddresses($customer_id, $city_id)
    {
        return CustomerAddress::where('customer_id', $customer_id)
            ->where('city_id', $city_id)
            ->get();
    }


    public function getCustomerAddresses($customer_id)
    {
        return CustomerAddress::where('customer_id', $customer_id)
            ->get();
    }
    public function getCustomerAddressesbyID($address_id)
    {
        return CustomerAddress::where('id', $address_id)
            ->first();
    }
}

