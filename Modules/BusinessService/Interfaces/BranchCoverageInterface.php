<?php

namespace Modules\BusinessService\Interfaces;

interface BranchCoverageInterface
{
    public function createBranchCoverage($active_status, $city_id, $state, $country, $branch_id, $area_id = null,);
    public function getBranchCoverage();
    public function createBranchCoverageDeliverySlot($branch_coverage_id, $delivery_slot_id);
}
