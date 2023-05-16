<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\Overtimes;
use Modules\HRManagement\Interfaces\OvertimeInterface;

class OvertimesRepository implements OvertimeInterface
{

    /**
     * @param $title
     * @param $date
     * @param $description
     * @param $payAdjustment
     * @param $hours
     * @param $status
     * @param $timesheetId
     * @return mixed
     */
    public function createOvertime($title, $date, $description = null, $payAdjustment = null, $hours = null, $status = "pending", $timesheetId = null)
    {
        $overtime = new Overtimes([
            "title"=>$title,
            "date"=>$date,
            "description"=>$description,
            "pay_adjustment"=>$payAdjustment,
            "hours"=>$hours,
            "status"=>$status,
            "timesheet_id"=>$timesheetId
        ]);

        return $overtime->save();
    }

    /**
     * @param $id
     * @param $title
     * @param $date
     * @param $description
     * @param $payAdjustment
     * @param $hours
     * @param $status
     * @param $timesheetId
     * @return mixed
     */
    public function updateOvertime($id, $title = null, $date = null, $description = null, $payAdjustment = null, $hours = null, $status = "pending", $timesheetId = null)
    {
        $overtime = Overtimes::find($id);
        $overtime->description = $description;
        if ($title){
            $overtime->title = $title;
        }
        if ($payAdjustment){
            $overtime->pay_adjustment = $payAdjustment;
        }
        if ($hours){
            $overtime->hours = $hours;
        }
        if ($date){
            $overtime->date = $date;
        }
        if ($status){
            $overtime->status = $status;
        }
        if ($timesheetId){
            $overtime->timesheet_id = $timesheetId;
        }

        return $overtime->save();
    }

    /**
     * @return mixed
     */
    public function getOvertimes()
    {
        return Overtimes::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getOvertime($id)
    {
        return Overtimes::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteOvertime($id)
    {
        return Overtimes::where(["id"=>$id])->delete();
    }

    /**
     * @param $timesheetId
     * @return mixed
     */
    public function getOvertimeByTimesheet($timesheetId)
    {
        return Overtimes::where(["timesheet_id"=>$timesheetId])->get();
    }
}
