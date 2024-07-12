<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\Branch;
use Modules\BusinessService\Entities\Business;
use Modules\BusinessService\Entities\BusinessCustomer;
use Modules\BusinessService\Interfaces\BusinessInterface;

class BusinessRepository implements BusinessInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function createBusiness(
        $name,
        $business_category_id,
        $admin,
        $status,
        $trade_licence_file = null,
        $state_legal_id = null,
        $trn_number = null,
        $trn_file = null,
        $logo = null
    ) {
        $business = Business::create([
            "name" => $name,
            "logo" => $logo,
            "business_category_id" => $business_category_id,
            "admin_id" => $admin,
            "status" => $status,
            "trade_licence_file" => $trade_licence_file,
            "trn_file" => $trn_file,
            "trn_number" => $trn_number,
            "state_legal_id" => $state_legal_id,
        ]);

        return $business;
    }

    public function getNewBusinesses()
    {
        return Business::where(["status" => "NEW_REQUEST"])->get();
    }

    public function get()
    {
        return Business::all();
    }

    public function getActiveBusinesses()
    {
        return Business::where(["active_status" => "1"])->get();
    }

    public function getBusiness($id)
    {
        return Business::find($id);
    }

    public function getSingleBusinessWhere($where)
    {
        return Business::where($where)->first();
    }


    public function update($id, $data)
    {
        return Business::where('id', $id)->update($data);
    }


    // =============================================================================================
    // ===============================  A P I   F U N C T I O N S   ================================
    // =============================================================================================

    public function getFormattedBusinessInfo($business_id)
    {

        return Business::with(
            [
                'branches' => function ($query) {
                    $query->select('id as branch_id', 'name', 'address as pickup_address',  'business_id');
                },
            ]
        )
            ->select('id', 'name', 'business_category_id')
            ->where('id', $business_id)
            ->get();
    }

    public function getFormattedBusinessCustomers($business_id)
    {

        return Business::with(
            [
                'branches' => function ($query) {
                    $query->select('id as branch_id', 'name', 'address as pickup_address',  'business_id');
                },
            ]
        )
            ->select('id', 'name', 'business_category_id')
            ->where('id', $business_id)
            ->get();
    }
}
