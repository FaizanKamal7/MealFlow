<?php

namespace Modules\HRManagement\Interfaces;

interface PayrollInterface
{
public function createPayroll($payRate,$deductions,$bonus,$hoursWorked,$grossPay,$taxWithheld,$netPay,$startDate,$endDate,$employeeId);
public function updatePayroll($id,$payRate=null,$deductions=null,$bonus=null,$hoursWorked=null,$grossPay=null,$taxWithheld=null,$netPay=null,$startDate=null,$endDate=null,$employeeId=null);
public function getPayrolls();
public function getPayroll($id);
public function getPayrollByEmployee($employeeId);
public function deletePayroll($id);
public function getPayrollByCustomFilter($startDate,$endDate);
}
