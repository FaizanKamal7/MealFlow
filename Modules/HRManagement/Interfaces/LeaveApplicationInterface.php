<?php

namespace Modules\HRManagement\Interfaces;

interface LeaveApplicationInterface
{
public function createLeaveApplication($duration,$startDate,$endDate,$leavePolicyId,$employeeId,$status="pending",$description=null,$attachment=null,$consumed=null,$impactOnPay=null);
public function updateLeaveApplication($id,$duration=null,$startDate=null,$endDate=null,$leavePolicyId=null,$employeeId=null,$status="pending",$description=null,$attachment=null,$consumed=null,$impactOnPay=null);

public function getLeaveApplications();

public function getLeaveApplication($id);
public function deleteLeaveApplication($id);
public function getLeaveApplicationByEmployee($employeeId);
public function getLeaveByEmployeeAndPolicyRecord($employeeId,$policyRecordId);

}
