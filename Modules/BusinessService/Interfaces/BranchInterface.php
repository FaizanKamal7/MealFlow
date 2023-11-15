<?php

namespace Modules\BusinessService\Interfaces;

interface BranchInterface
{
    public function getBranch();
    public function createBranch(
        $name,
        $phone,
        $address,
        $business_id,
        $country_id = null,
        $state_id = null,
        $city_id = null,
        $area_id = null,
        $active_status = null,
        $is_main_branch = null,
        $latitude = null,
        $longitude = null
    );
    public function getBusinessBranches($business_id);
    public function getBusinessBranch($where);
}
