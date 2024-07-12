<?php

namespace Modules\HRManagement\Interfaces;

interface DepartmentInterface
{
    public function createDepartment($departmentName,$status="active");
    public function updateDepartment($id,$departmentName=null,$status=null);
    public function getDepartments();
    public function getDepartment($id);
    public function deleteDepartment($id);
}