<?php

namespace Modules\HRManagement\Interfaces;

interface LeavePolicyRecordInterface
{
public function createLeavePolicyRecord($leavePolicyId,$leaveTypeId,$allowed,$impactOnPay);
public function updateLeavePolicyRecord($id,$leavePolicyId=null,$leaveTypeId=null,$allowed=null,$impactOnPay=null);
public function getLeavePolicyRecords();
public function getLeavePolicyRecord($id);
public function getLeavePolicyRecordById($id);
public function deleteLeavePolicyRecord($id);
public function getLeavePolicyRecordByEmployee($employeeId);
public function existsLeavePolicyByPolicyIDLeaveTypeID($policyID, $leaveTypeID);
public function getImpactOnPay($leave_type);
}
