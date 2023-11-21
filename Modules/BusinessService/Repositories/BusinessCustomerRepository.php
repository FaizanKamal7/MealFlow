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

        // $businessCustomer = BusinessCustomer::where([
        //     'customer_id' => $customer_id,
        //     'business_id' => $business_id,
        // ])->first();
        // if (!$businessCustomer) {
        //     $businessCustomer = BusinessCustomer::create([
        //         'customer_id' => $customer_id,
        //         'business_id' => $business_id,
        //     ]);
        // }
        // return $businessCustomer;
        // Query Builder
        // $businessCustomer = DB::table('business_customers')
        //     ->where('customer_id', $customer_id)
        //     ->where('business_id', $business_id)
        //     ->first();

        // if (!$businessCustomer) {
        //     $businessCustomerId = DB::table('business_customers')
        //         ->insert([
        //             'id' => "213242",
        //             'customer_id' => $customer_id,
        //             'business_id' => $business_id,
        //         ]);
        //     $businessCustomer = DB::table('users')->find($businessCustomerId);
        // }
        // // dd($businessCustomer);
        // return $businessCustomer;

        // Your SQL query
        // $sql = "INSERT INTO business_customers (customer_id, business_id) 
        // SELECT * FROM (SELECT '$customer_id', '$business_id') AS tmp 
        // WHERE NOT EXISTS (
        //     SELECT 1 FROM business_customers 
        //     WHERE customer_id = '$customer_id' AND business_id = '$business_id'
        // ) LIMIT 1";

        // $result = DB::statement($sql);
        // return $result;
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
    public function getSingleBusinessCustomerWhere($where)
    {
        return BusinessCustomer::where($where)->first();
    }



    public function getCustomersInfoWithIDsArray($where)
    {
        return BusinessCustomer::where($where)->first();
    }
}
