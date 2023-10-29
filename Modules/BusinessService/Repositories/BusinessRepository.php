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
        $logo,
        $card_name,
        $card_number,
        $card_expiry_month,
        $card_expiry_year,
        $card_cvv,
        $business_category_id,
        $admin,
        $status,
        $trade_licence_file,
        $state_legal_id,
        $trn_number,
        $trn_file
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
        // $business->save();
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

    public function update($id, $data)
    {
        return Business::where('id', $id)->update($data);
    }
}
