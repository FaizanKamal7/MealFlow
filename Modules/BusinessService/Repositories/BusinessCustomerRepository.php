<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\BusinessCustomer;
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;
use Illuminate\Support\Facades\DB;

class BusinessCustomerRepository implements BusinessCustomerInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function create($customer_id, $business_id)
    {
        // Try to find the business customer with the given customer_id and business_id
        // If it does not exist, then create it
        return BusinessCustomer::firstOrCreate([
            'customer_id' => $customer_id,
            'business_id' => $business_id,
        ]);
    }

    public function getBusinessCustomer($business_id)
    {
        $result =  BusinessCustomer::where(['business_id' => $business_id])->get();
        // $result->load('customer');
        // // $result = DB::table('business_customers')
        // //     ->join('customers', 'business_customers.customer_id', '=', 'customers.id')
        // //     ->select('business_customers.*', 'customers.*')
        // //     ->where('business_customers.business_id', $business_id)
        // //     ->get();


        return $result;
    }

    public function get()
    {
        return BusinessCustomer::all();
    }
    public function getOneBusinessCustomer($id)
    {
        return BusinessCustomer::find($id);
    }
}
