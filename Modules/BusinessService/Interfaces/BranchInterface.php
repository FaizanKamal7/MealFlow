<?php

namespace Modules\BusinessService\Interfaces;

interface BranchInterface
{
    public function createBranch(
        $name,
        $address,
        $phone,
        $active_status,
        $is_main_branch,
        $business_id
    );
}
