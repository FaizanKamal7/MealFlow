<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\Business;
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
}
