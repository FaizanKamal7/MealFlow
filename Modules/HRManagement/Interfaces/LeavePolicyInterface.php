<?php

namespace Modules\HRManagement\Interfaces;

interface LeavePolicyInterface
{
public function createLeavePolicy($policyName,$description=null);
public function updateLeavePolicy($id,$policyName=null,$description=null);
public function getLeavePolicies();
public function getLeavePolicy($id);
public function deleteLeavePolicy($id);
}
