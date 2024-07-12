<?php

namespace Modules\HRManagement\Interfaces;

interface EmployeesInterface
{
public function createEmployee($firstName,$lastName,$personalEmailAddress,$personalPhoneNumber,$companyEmailAddress=null,$companyPhoneNumber=null,$picture=null,$city=null,$country=null,$maritalStatus=null,$hireDate=null,$probationStartDate=null,$probationEndDate=null,$designationId=null,$leavePolicyId=null, $employeeType=null, $contractStartDate=null, $contractEndDate=null,$duty_start_time=null,$duty_end_time=null, $userId=null);
public function updateEmployee($id,$firstName,$lastName,$personalEmailAddress,$personalPhoneNumber,$companyEmailAddress,$companyPhoneNumber,$picture,$city,$country,$maritalStatus,$hireDate,$probationStartDate,$probationEndDate,$designationId,$leavePolicyId,  $employeeType, $contractStartDate, $contractEndDate, $userId);
public function getEmployees();
public function getEmployee($id);
public function deleteEmployee($id);

public function updateEmployeePersonalInformation($id,$firstName=null,$lastName=null,$personalEmailAddress=null,$personalPhoneNumber=null,$companyEmailAddress=null,$companyPhoneNumber=null,$picture=null,$city=null,$country=null,$maritalStatus=null,$hireDate=null,$probationStartDate=null,$probationEndDate=null);

public function updateEmployment($id,$designationId,$employType,$contractStart,$contractEnd);

public function updateEmployeeBank($id,$bankName,$accountTitle,$accountNumber,$iban,$swiftCode,$sortCode,$accountCurrency);

public function updateLeavePolicy($id,$leavePolicy);

public function updateSalary($id,$basicSalary,$salaryCycle,$taxable,$taxClass);
}
