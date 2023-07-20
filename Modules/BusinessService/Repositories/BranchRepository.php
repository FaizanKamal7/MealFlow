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

    public function createBranch($name, $address, $phone, $active_status = null, $business_id, $is_main_branch = null)
    {
        $branch = Branch::create([
            "name" => $name,
            "address" => $address,
            "phone" => $phone,
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
}
