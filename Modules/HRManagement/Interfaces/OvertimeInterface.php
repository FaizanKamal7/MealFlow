<?php

namespace Modules\HRManagement\Interfaces;

interface OvertimeInterface
{
public function createOvertime($title,$date,$description=null,$payAdjustment=null,$hours=null,$status="pending",$timesheetId=null);
public function updateOvertime($id,$title=null,$date=null,$description=null,$payAdjustment=null,$hours=null,$status="pending",$timesheetId=null);
public function getOvertimes();
public function getOvertime($id);
public function deleteOvertime($id);
public function getOvertimeByTimesheet($timesheetId);
}
