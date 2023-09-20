<?php

namespace Modules\BusinessService\Interfaces;

interface BranchInterface
{
    public function getBranch();
    public function createBranch(
        $name,
        $phone,
        $address,
        $country_id,
        $state_id,
        $city_id,
        $area_id,
        $active_status,
        $is_main_branch,
        $business_id,
        $latitude,
        $longitude
    );
    public function getBusinessBranches($business_id);
}
