<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\Branch;
use Modules\BusinessService\Interfaces\BranchInterface;

class BranchRepository implements BranchInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function createBranch(
        $name,
        $phone,
        $address,
        $country_id,
        $state_id,
        $city_id,
        $area_id,
        $active_status = null,
        $business_id,
        $is_main_branch = null,
        $latitude = null,
        $longitude = null
    ) {
        $branch = Branch::create([
            "name" => $name,
            "phone" => $phone,
            "address" => $address,
            "country_id" => $country_id,
            "state_id" => $state_id,
            "city_id" => $city_id,
            "area_id" => $area_id,
            "active_status" => $active_status,
            "is_main_branch" => $is_main_branch,
            "business_id" => $business_id,
        ]);

        // $branch->save();
        return $branch;
    }

    public function getBranch()
    {
        return Branch::all();
    }

    public function getBusinessCities($business_id)
    {
    }
}
