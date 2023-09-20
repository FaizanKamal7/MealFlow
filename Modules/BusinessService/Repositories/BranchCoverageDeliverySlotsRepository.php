<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\BranchCoverageDeliverySlots;
use Modules\BusinessService\Interfaces\BranchCoverageDeliverySlotsInterface;

class BranchCoverageDeliverySlotsRepository implements BranchCoverageDeliverySlotsInterface
{
    public function createBranchCoverageDeliverySlot($branch_coverage_id, $delivery_slot_id)
    {
        $branch_coverage_delivery_slot =  BranchCoverageDeliverySlots::create([
            "branch_coverage_id" => $branch_coverage_id,
            "delivery_slot_id" => $delivery_slot_id,

        ]);
        $branch_coverage_delivery_slot->save();
        return $branch_coverage_delivery_slot;
    }
}
