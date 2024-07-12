<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\Departments;
use Modules\HRManagement\Interfaces\DepartmentInterface;

class DepartmentsRepository implements DepartmentInterface
{

    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */
    public function createDepartment($departmentName, $status = "active")
    {
        $department = new Departments([
            "department_name"=>$departmentName,
            "status"=>$status,
        ]);
        $department->save();
        return $department;
    }

    /**
     * @param $id
     * @param $departmentName
     * @param $status
     * @return mixed
     */
    public function updateDepartment($id, $departmentName = null, $status = null)
    {
        $department = Departments::find($id);

        if ($departmentName){
            $department->department_name = $departmentName;
        }
        if ($status){
            $department->status=$status;
        }

        return $department->save();
    }

    /**
     * @return mixed
     */
    public function getDepartments()
    {
        return Departments::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDepartment($id)
    {
        return Departments::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteDepartment($id)
    {
        return Departments::where(["id"=>$id])->delete();
    }
}
