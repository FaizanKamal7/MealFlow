<?php

namespace Modules\BusinessService\Repositories;

use DB;
use Modules\BusinessService\Entities\Customer;
use Modules\BusinessService\Interfaces\CustomerInterface;

class CustomerRepository implements CustomerInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function get()
    {
        return Customer::with('user')->with('customerAddresses')->get();
    }


    public function create($data)
    {
        return Customer::firstOrCreate($data);
    }

    public function getCustomer($id)
    {
        // return Customer::find($id);
        // return Customer::where("id", $id)->get();
        return DB::table('customers')->where('id', $id)->first();

    }

    public function customerWithMatchingPhoneNoInUsers($phone_no)
    {
        return Customer::with('user')->whereHas('user', function ($query) use ($phone_no) {
            $query->where('phone', $phone_no);
        })->first();
    }

    public function customerWithMatchingEmailInUsers($email)
    {
        return Customer::with('user')->whereHas('user', function ($query) use ($email) {
            $query->where('email', $email);
        })->first();
    }

    public function customerWithMatchingPhoneNoInSecondaryNumbers($phone_no)
    {
        return Customer::with('user')->whereHas('customer_secondary_numbers', function ($query) use ($phone_no) {
            $query->where('phone_number', $phone_no);
        })->first();
    }


    // public function updateCustomersDeliverySlotInfo($where, $data)
    // {
    //     return Customer::update;
    // }
}
