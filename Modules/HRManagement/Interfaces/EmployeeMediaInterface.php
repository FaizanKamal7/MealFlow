<?php

namespace Modules\HRManagement\Interfaces;

interface EmployeeMediaInterface
{
public function createEmployeeMedia($path,$employeeId,$type=null);
public function updateEmployeeMedia($id,$path=null,$employeeId=null,$type=null);
public function getEmployeeMedia($employeeId);
public function getAllEmployeeMedia();
public function getEmployeeMediaWithType($employeeId,$type);
public function getEmployeeMediaSingle($id);
public function deleteEmployeeMedia($id);

}
