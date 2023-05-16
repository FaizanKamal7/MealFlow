<?php

namespace Modules\HRManagement\Interfaces;

interface TimesheetInterface
{
        public function createTimesheet($sheetTitle,$date,$employeeId,$description=null,$hoursWorked=null,$status="pending");
        public function updateTimesheet($id,$sheetTitle=null,$date=null,$employeeId=null,$description=null,$hoursWorked=null,$status=null);
        public function getTimesheets();
        public function getTimesheet($id);
        public function deleteTimesheet($id);
        public function getTimesheetByEmployee($employeeId);

}
