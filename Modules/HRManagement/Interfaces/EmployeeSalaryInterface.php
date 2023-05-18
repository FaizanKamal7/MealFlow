<?php

namespace Modules\HRManagement\Interfaces;

interface EmployeeSalaryInterface
{
public function createEmployeeSalary($basicSalary,$cycle,$employeeId,$taxable,$taxId);
public function updateEmployeeSalary($id,$basicSalary=null,$cycle=null,$employeeId=null,$taxable=null,$taxId=null);
public function getAllEmployeeSalary();
public function getEmployeeSalary($employeeId);
public function getEmployeeSalarySingle($id);
public function deleteEmployeeSalary($id);
}
