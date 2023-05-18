<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\LeavePolicyRecords;
use Modules\HRManagement\Interfaces\LeavePolicyRecordInterface;

class LeavePolicyRecordsRepository implements LeavePolicyRecordInterface
{

    /**
     * @param $leavePolicyId
     * @param $leaveTypeId
     * @param $allowed
     * @param $impactOnPay
     * @return mixed
     */
    public function createLeavePolicyRecord($leavePolicyId, $leaveTypeId, $allowed, $impactOnPay)
    {
        $leavePolicyRecord = new LeavePolicyRecords([
            "leave_policy_id"=>$leavePolicyId,
            "leave_type_id"=>$leaveTypeId,
            "allowed"=>$allowed,
            "impact_on_pay"=>$impactOnPay,

        ]);
        return $leavePolicyRecord->save();
    }

    /**
     * @param $id
     * @param $leavePolicyId
     * @param $leaveTypeId
     * @param $allowed
     * @param $impactOnPay
     * @return mixed
     */
    public function updateLeavePolicyRecord($id, $leavePolicyId = null, $leaveTypeId = null, $allowed = null, $impactOnPay = null)
    {
        $leavePolicyRecord = LeavePolicyRecords::find($id);
        if ($leavePolicyId){
            $leavePolicyRecord->leave_policy_id = $leavePolicyId;
        }
        if ($leaveTypeId){
            $leavePolicyRecord->leave_type_id = $leaveTypeId;
        }
        if ($allowed){
            $leavePolicyRecord->allowed = $allowed;
        }
        if ($impactOnPay){
            $leavePolicyRecord->impact_on_pay = $impactOnPay;
        }

        return $leavePolicyRecord->save();
    }

    /**
     * @return mixed
     */
    public function getLeavePolicyRecords()
    {
        return LeavePolicyRecords::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getLeavePolicyRecord($id)
    {
        return LeavePolicyRecords::where(["leave_policy_id"=>$id])->with('leaveType')->get();
    }

    public function getLeavePolicyRecordById($id)
    {
        return LeavePolicyRecords::where(["id"=>$id])->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteLeavePolicyRecord($id)
    {
        return LeavePolicyRecords::where(["id"=>$id])->delete();
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getLeavePolicyRecordByEmployee($employeeId)
    {
        return LeavePolicyRecords::where(["employee_id"=>$employeeId])->get();
    }


    public function existsLeavePolicyByPolicyIDLeaveTypeID($policyID, $leaveTypeID){
        return LeavePolicyRecords::where(["leave_policy_id"=>$policyID, "leave_type_id"=>$leaveTypeID])->exists();
    }
    public function getImpactOnPay($leave_type)
    {
        return LeavePolicyRecords::where(["leave_type_id"=>$leave_type])->first();
    }
}
