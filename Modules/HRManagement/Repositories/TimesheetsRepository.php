<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\Timesheets;
use Modules\HRManagement\Interfaces\TimesheetInterface;
use Ramsey\Uuid\Type\Time;

class TimesheetsRepository implements TimesheetInterface
{

    /**
     * @param $sheetTitle
     * @param $date
     * @param $employeeId
     * @param $description
     * @param $hoursWorked
     * @param $status
     * @return mixed
     */
    public function createTimesheet($sheetTitle, $date, $employeeId, $description = null, $hoursWorked = null, $status = "pending")
    {
       $timesheet = new Timesheets([
           "sheet_title"=>$sheetTitle,
           "date"=>$date,
           "employee_id"=>$employeeId,
           "description"=>$description,
           "hours_worked"=>$hoursWorked,
           "status"=>$status
       ]);

       return $timesheet->save();
    }

    /**
     * @param $id
     * @param $sheetTitle
     * @param $date
     * @param $employeeId
     * @param $description
     * @param $hoursWorked
     * @param $status
     * @return mixed
     */
    public function updateTimesheet($id, $sheetTitle = null, $date = null, $employeeId = null, $description = null, $hoursWorked = null, $status = null)
    {
        $timesheet= Timesheets::find($id);
        $timesheet->description = $description;
        if ($sheetTitle){
            $timesheet->sheet_title = $sheetTitle;
        }
        if ($date){
            $timesheet->date = $date;
        }
        if ($employeeId){
            $timesheet->employee_id=$employeeId;
        }
        if ($hoursWorked){
            $timesheet->hours_worked = $hoursWorked;
        }
        if ($status){
            $timesheet->status = $status;
        }

        return $timesheet->save();
    }

    /**
     * @return mixed
     */
    public function getTimesheets()
    {
        return Timesheets::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTimesheet($id)
    {
        return Timesheets::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteTimesheet($id)
    {
        return Timesheets::where(["id"=>$id])->delete();
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getTimesheetByEmployee($employeeId)
    {
        return Timesheets::where(["employee_id"=>$employeeId])->get();
    }
}
