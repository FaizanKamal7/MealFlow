<?php

namespace Modules\HRManagement\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\HRManagement\Entities\Attendance;
use Modules\HRManagement\Interfaces\AttendanceInterface;

class AttendanceRepository implements AttendanceInterface
{

    /**
     * @param $dateTime
     * @param $status
     * @param $employeeId
     * @return mixed
     */
    public function createAttendance($dateTime, $status, $employeeId)
    {
        $attendance = new Attendance([
            "date_time"=>$dateTime,
            "status"=>$status,
            "employee_id"=>$employeeId,
        ]);

        return $attendance->save();
    }

    /**
     * @param $id
     * @param $dateTime
     * @param $status
     * @param $employeeId
     * @return mixed
     */
    public function updateAttendance($id, $dateTime = null, $status = null, $employeeId = null)
    {
        $attendance = Attendance::find($id);
        if ($dateTime){
            $attendance->date_time = $dateTime;
        }
        if ($status){
            $attendance->status = $status;
        }
        if ($employeeId){
            $attendance->employee_id=$employeeId;
        }

        return $attendance->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteAttendance($id)
    {
        return Attendance::wheree(["id"=>$id])->delete();
    }

    /**
     * @return mixed
     */
    public function getAllAttendance()
    {
        return Attendance::all();
    }

    /**
     * @param $dateTime
     * @return mixed
     */
    public function getAttendanceByDate($dateTime)
    {
       return Attendance::where(["date_time"=>$dateTime]);
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getAttendanceByEmployee($employeeId)
    {
        return Attendance::where(["employee_id"=>$employeeId])->get();
    }

    /**
     * @param $month
     * @return mixed
     */
    public function getAttendanceByMonth($month)
    {
        return DB::table("attendances")->whereMonth("date_time", $month)->get();
    }

    /**
     * @param null $employee
     * @param null $department
     * @param null $month
     * @param null $year
     * @return mixed
     */
    public function getAttendanceByCustomFilter($employee=null, $department=null, $month=null,$year=null)
    {
        $attendance = null;
        if ($employee){
            $attendance = Attendance::where(["employee_id"=>$employee])->get();
        }
//        return DB::table("attendances")->whereBetween("date_time", [$fromDate,$toDate])->get();
    }

    public function getAttendanceByEmployeeMonthYear($employeeId, $month, $year){
        return Attendance::where('employee_id', $employeeId)
            ->whereYear('date_time', $year)
            ->whereMonth('date_time', $month)
            ->orderBy('date_time')
            ->get();
    }

    public function getAttendanceByMonthYear($month, $year){
        return DB::table('employees')
            ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
            ->select(DB::raw('CONCAT(employees.first_name, " ", employees.last_name) AS emp_name'), 'employees.id AS emp_id','attendances.id','attendances.date_time', 'attendances.status', DB::raw('DATE(attendances.date_time) AS date'))
            ->whereYear('date_time', $year)
            ->whereMonth('date_time', $month)
            ->orderBy('employees.id')
            ->orderBy('attendances.date_time')
            ->get();
    }

    public function existsAttendance($employeeId, $date){
        return Attendance::where('employee_id', $employeeId)
            ->whereDate('date_time', $date)
            ->exists();
    }
}
