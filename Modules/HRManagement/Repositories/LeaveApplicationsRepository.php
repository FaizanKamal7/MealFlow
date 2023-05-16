<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\LeaveApplications;
use Modules\HRManagement\Interfaces\LeaveApplicationInterface;

class LeaveApplicationsRepository implements LeaveApplicationInterface
{

    /**
     * @param $duration
     * @param $startDate
     * @param $endDate
     * @param $leavePolicyId
     * @param $employeeId
     * @param $status
     * @param $description
     * @param $attachment
     * @param $consumed
     * @param $impactOnPay
     * @return mixed
     */
    public function createLeaveApplication($duration, $startDate, $endDate, $leavePolicyId, $employeeId, $status = "pending", $description = null, $attachment = null, $consumed = null, $impactOnPay = null)
    {
        $leaveApplication = new LeaveApplications([
            "duration"=>$duration,
            "start_date"=>$startDate,
            "end_date"=>$endDate,
            "description"=>$description,
            "status"=>$status,
            "attachment"=>$attachment,
            "consumed"=>$consumed,
            "impact_on_pay"=>$impactOnPay,
            "leave_policy_record_id"=>$leavePolicyId,
            "employee_id"=>$employeeId
        ]);

        return $leaveApplication->save();
    }

    /**
     * @param $id
     * @param $duration
     * @param $startDate
     * @param $endDate
     * @param $leavePolicyId
     * @param $employeeId
     * @param $status
     * @param $description
     * @param $attachment
     * @param $consumed
     * @param $impactOnPay
     * @return mixed
     */
    public function updateLeaveApplication($id, $duration = null, $startDate = null, $endDate = null, $leavePolicyId = null,
                                           $employeeId = null, $status = "pending", $description = null, $attachment = null,
                                           $consumed = null, $impactOnPay = null)
    {
        $leaveApplication = LeaveApplications::find($id);
        if ($duration){
            $leaveApplication->duration = $duration;
        }
        if ($startDate){
            $leaveApplication->start_date = $startDate;
        }
        if ($endDate){
            $leaveApplication->end_date = $endDate;
        }
        if ($leavePolicyId){
            $leaveApplication->leave_policy_record_id = $leavePolicyId;
        }
        if ($employeeId){
            $leaveApplication->employee_id= $employeeId;
        }
        if ($status){
            $leaveApplication->status = $status;
        }
        if ($description){
            $leaveApplication->description = $description;
        }
        if ($attachment){
            $leaveApplication->attachment = $attachment;
        }
        if ($consumed){
            $leaveApplication->consumed = $consumed;
        }
        if ($impactOnPay){
            $leaveApplication->impact_on_pay = $impactOnPay;
        }

        return $leaveApplication->save();
    }

    /**
     * @return mixed
     */
    public function getLeaveApplications()
    {
        return LeaveApplications::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getLeaveApplication($id)
    {
        return LeaveApplications::find($id);
    }



    /**
     * @param $id
     * @return mixed
     */
    public function deleteLeaveApplication($id)
    {
        return LeaveApplications::where(["id"=>$id])->delete();
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getLeaveApplicationByEmployee($employeeId)
    {
        return LeaveApplications::where(["employee_id"=>$employeeId])->get(['id', 'name']);
    }

    public function getLeaveByEmployeeAndPolicyRecord($employeeId,$policyRecordId)
    {
        return LeaveApplications::where(["employee_id"=>$employeeId, "leave_policy_record_id"=>$policyRecordId])->get();

    }
}
