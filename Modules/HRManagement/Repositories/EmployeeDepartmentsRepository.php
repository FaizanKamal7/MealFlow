<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\EmployeeDepartments;
use Modules\HRManagement\Interfaces\EmployeeDepartmentInterface;

class EmployeeDepartmentsRepository implements EmployeeDepartmentInterface
{

    /**
     * @param $employeeId
     * @param $departmentId
     * @param $isManager
     * @param $isPrimary
     * @return mixed
     */
    public function createEmployeeDepartment($employeeId, $departmentId, $isManager = false, $isPrimary = false)
    {
        $employeeDepartment = new EmployeeDepartments([
            "is_manager"=>$isManager,
            "is_primary"=>$isPrimary,
            "employee_id"=>$employeeId,
            "department_id"=>$departmentId,
        ]);

        return $employeeDepartment->save();
    }

    /**
     * @param $id
     * @param $employeeId
     * @param $departmentId
     * @param $isManager
     * @param $isPrimary
     * @return mixed
     */
    public function updateEmployeeDepartment($id, $employeeId = null, $departmentId = null, $isManager = null, $isPrimary = null)
    {
        $employeeDepartment = EmployeeDepartments::find($id);
        $employeeDepartment->is_manager = $isManager;
        if ($employeeId){
            $employeeDepartment->employee_id=$employeeId;
        }
        if ($departmentId){
            $employeeDepartment->department_id = $departmentId;
        }
        if ($isPrimary){
            $employeeDepartment->is_primary = $isPrimary;
        }
        return $employeeDepartment->save();
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getEmployeeDepartments($employeeId)
    {
        return EmployeeDepartments::where(["employee_id"=>$employeeId])->get();
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getEmployeeDepartmentsByDpt($departmentId)
    {
        return EmployeeDepartments::where(["department_id"=>$departmentId])->get();
    }
    public function getEmployeesByDepartment($departmentId){
        return EmployeeDepartments::where(["department_id"=>$departmentId])->with('employee')->get();
    }
    /**
     * @return mixed
     */
    public function getAllEmployeeDepartments()
    {
       return EmployeeDepartments::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEmployeeDepartment($id)
    {
        return EmployeeDepartments::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteEmployeeDepartment($id)
    {
        return EmployeeDepartments::where(["id"=>$id])->delete();
    }
}
