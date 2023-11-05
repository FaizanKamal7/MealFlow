<?php

namespace Modules\BusinessService\Repositories;

use Illuminate\Support\Facades\DB;
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

    public function makeDefaultAddress($address_id, $customer_id)
    {
        // Set all addresses to not default for this customer
        CustomerAddress::where('customer_id', $customer_id)->update(['is_default' => false]);

        // Set the specified address as default
        CustomerAddress::where('customer_id', $customer_id)
            ->where('id', $address_id)
            ->update(['is_default' => true]);
    }
}
