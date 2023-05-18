<?php

namespace Modules\HRManagement\Interfaces;

interface LeaveTypesInterface
{
public function createLeaveType($name,$color);
public function updateLeaveType($id,$name=null,$color=null);
public function getLeaveTypes();
public function getLeaveType($id);
public function deleteLeaveType($id);
}
