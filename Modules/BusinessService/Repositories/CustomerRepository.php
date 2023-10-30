<?php

namespace Modules\BusinessService\Repositories;

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
        return Customer::create($data);
    }

    public function customerWithMatchingPhoneNoInUsers($phone_no)
    {
        return Customer::whereHas('user', function ($query) use ($phone_no) {
            $query->where('phone', $phone_no);
        })->first();
    }

    public function customerWithMatchingEmailInUsers($email)
    {
        return Customer::whereHas('user', function ($query) use ($email) {
            $query->where('email', $email);
        })->first();
    }

    public function customerWithMatchingPhoneNoInSecondaryNumbers($phone_no)
    {
        return  Customer::whereHas('customer_secondary_numbers', function ($query) use ($phone_no) {
            $query->where('phone_number', $phone_no);
        })->first();
    }
}
