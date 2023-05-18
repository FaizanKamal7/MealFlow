<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\LeavePolicy;
use Modules\HRManagement\Interfaces\LeavePolicyInterface;

class LeavePolicyRepository implements LeavePolicyInterface
{

    /**
     * @param $policyName
     * @param $description
     * @return mixed
     */
    public function createLeavePolicy($policyName, $description = null)
    {
       $leavePolicy = new LeavePolicy([
          "policy_name"=>$policyName,
          "description"=>$description
       ]);
        $leavePolicy->save();
       return $leavePolicy;
    }

    /**
     * @param $id
     * @param $policyName
     * @param $description
     * @return mixed
     */
    public function updateLeavePolicy($id, $policyName = null, $description = null)
    {
        $leavePolicy = LeavePolicy::find($id);
        if ($policyName){
            $leavePolicy->policy_name = $policyName;
        }
        if ($description){
            $leavePolicy->description = $description;
        }

        return $leavePolicy->save();
    }

    /**
     * @return mixed
     */
    public function getLeavePolicies()
    {
       return LeavePolicy::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getLeavePolicy($id)
    {
        return LeavePolicy::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteLeavePolicy($id)
    {
        return LeavePolicy::where(["id"=>$id])->delete();
    }
}
