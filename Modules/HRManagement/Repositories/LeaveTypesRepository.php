<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\LeaveTypes;
use Modules\HRManagement\Interfaces\LeaveTypesInterface;

class LeaveTypesRepository implements LeaveTypesInterface
{

    /**
     * @param $name
     * @param $color
     * @return mixed
     */
    public function createLeaveType($name, $color)
    {
        $leaveType = new LeaveTypes([
            "name"=>$name,
            "color"=>$color
        ]);

        return $leaveType->save();
    }

    /**
     * @param $id
     * @param $name
     * @param $color
     * @return mixed
     */
    public function updateLeaveType($id, $name = null, $color = null)
    {
        $leaveType = LeaveTypes::find($id);
        if ($name){
            $leaveType->name = $name;
        }
        if ($color){
            $leaveType->color = $color;
        }

        return $leaveType->save();
    }

    /**
     * @return mixed
     */
    public function getLeaveTypes()
    {
        return LeaveTypes::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getLeaveType($id)
    {
       return LeaveTypes::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteLeaveType($id)
    {
        return LeaveTypes::where(["id"=>$id])->delete();
    }
}
