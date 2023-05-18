<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\EmployeeMedia;
use Modules\HRManagement\Interfaces\EmployeeMediaInterface;

class EmployeeMediaRepository implements EmployeeMediaInterface
{

    /**
     * @param $path
     * @param $employeeId
     * @param $type
     * @return mixed
     */
    public function createEmployeeMedia($path, $employeeId, $type = null)
    {
        $employeeMedia = new EmployeeMedia([
            "path" => $path,
            "employee_id" => $employeeId,
            "type" => $type,
        ]);


        return $employeeMedia->save();
    }

    /**
     * @param $id
     * @param $path
     * @param $employeeId
     * @param $type
     * @return mixed
     */
    public function updateEmployeeMedia($id, $path = null, $employeeId = null, $type = null)
    {
        $employeeMedia = EmployeeMedia::find($id);
        if ($path) {
            $employeeMedia->path = $path;
        }
        if ($employeeId) {
            $employeeMedia->employee_id = $employeeId;
        }
        $employeeMedia->type = $type;

        return $employeeMedia->save();
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getEmployeeMedia($employeeId)
    {
        return EmployeeMedia::where(["employee_id" => $employeeId])->get();
    }

    public function getEmployeeMediaWithType($employeeId,$type)
    {
        return EmployeeMedia::where(["employee_id" => $employeeId,"type"=>$type])->first();
    }
    /**
     * @return mixed
     */
    public function getAllEmployeeMedia()
    {
        return EmployeeMedia::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEmployeeMediaSingle($id)
    {
        return EmployeeMedia::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteEmployeeMedia($id)
    {
        return EmployeeMedia::where(["id" => $id])->delete();
    }
}
