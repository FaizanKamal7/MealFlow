<?php

namespace Modules\HRManagement\Interfaces;

interface EmployeeDepartmentInterface
{
  public function createEmployeeDepartment($employeeId,$departmentId,$isManager=false,$isPrimary=false);
  public function updateEmployeeDepartment($id,$employeeId=null,$departmentId=null,$isManager=false,$isPrimary=false);
  public function getEmployeeDepartmentsByDpt($departmentId);
  public function getEmployeesByDepartment($departmentId);
  public function getEmployeeDepartments($employeeId);
  public function getAllEmployeeDepartments();
  public function getEmployeeDepartment($id);
  public function deleteEmployeeDepartment($id);

}
