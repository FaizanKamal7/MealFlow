<?php

namespace Modules\HRManagement\Interfaces;

interface AttendanceInterface
{
    public function createAttendance($dateTime, $status, $employeeId);
    public function updateAttendance($id, $dateTime = null, $status = null, $employeeId = null);
    public function deleteAttendance($id);
    public function getAllAttendance();
    public function getAttendanceByDate($dateTime);
    public function getAttendanceByEmployee($employeeId);
    public function getAttendanceByMonth($month);
    public function getAttendanceByCustomFilter($employee = null, $department = null, $month = null, $year = null);
    public function getAttendanceByEmployeeMonthYear($employeeId, $month, $year);
    public function getAttendanceByMonthYear($month, $year);
    public function existsAttendance($employeeId, $date);
}
