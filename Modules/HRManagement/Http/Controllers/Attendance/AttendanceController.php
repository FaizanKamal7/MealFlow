<?php

namespace Modules\HRManagement\Http\Controllers\Attendance;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

use Modules\HRManagement\Interfaces\AttendanceInterface;
use Modules\HRManagement\Interfaces\DepartmentInterface;
use Modules\HRManagement\Interfaces\EmployeeDepartmentInterface;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Symfony\Component\HttpFoundation\Response;

class AttendanceController extends Controller
{
    // Meta Data

    private AttendanceInterface $attendanceRepository;
    private EmployeesInterface $employeesRepository;
    private DepartmentInterface $departmentRepository;
    private EmployeeDepartmentInterface $employeeDepartmentRepository;

    /**
     * @param AttendanceInterface $attendanceRepository
     * @param EmployeesInterface $employeesRepository
     * @param DepartmentInterface $departmentRepository
     */
    public function __construct(EmployeeDepartmentInterface $employeeDepartmentRepository, AttendanceInterface $attendanceRepository, EmployeesInterface $employeesRepository, DepartmentInterface $departmentRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
        $this->employeesRepository = $employeesRepository;
        $this->departmentRepository = $departmentRepository;
        $this->employeeDepartmentRepository = $employeeDepartmentRepository;

    }


    /**
     * Display a listing of the resource.
     */
    public function viewAttendance()
    {
        abort_if(Gate::denies('view_attendence'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $currentMonth = \Carbon\Carbon::now()->month;
        $currentYear = \Carbon\Carbon::now()->year;
        $numberOfDays = \Carbon\Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth;

        $attendances = $this->attendanceRepository->getAllAttendance();

        $employee = $this->employeesRepository->getEmployees();
        // $department = $this->departmentRepository->getDepartments();
        // return view('hrmanagement::attendance.all_attendance', ["attendances" => $attendances, "employees" => $employee, "departments" => $department]);


        $departments = $this->departmentRepository->getDepartments();
        $employees = $this->employeesRepository->getEmployees();
        $attendance_data = $this->attendanceRepository->getAttendanceByMonthYear(month: $currentMonth, year: $currentYear);
        // Hash Table
        $attendanceHash = [];
        // Create an array to hold the unique employee IDs
        $uniqueEmpIds = [];
        // Create an array to hold the final data
        $emp_Attendances = [];
        foreach ($attendance_data as $atd_data) {
            $attendanceHash[$atd_data->emp_id][$atd_data->date] = $atd_data;
            // Check if the employee ID already exists in the uniqueEmpIds array
            if (!in_array($atd_data->emp_id, $uniqueEmpIds)) {
                // If it doesn't exist, add the employee ID to the uniqueEmpIds array
                $uniqueEmpIds[] = $atd_data->emp_id;
                // Create a new array to hold the employee data
                $empData = [
                    'emp_id' => $atd_data->emp_id,
                    'emp_name' => $atd_data->emp_name,
                    'attendance_data' => []
                ];
                // Add the employee data to the finalData array
                $emp_Attendances[] = $empData;
            }


        }
        foreach ($emp_Attendances as &$employee) {
            $empId = $employee['emp_id'];
            $attendanceData = $employee['attendance_data'];
            for ($i = 1; $i <= $numberOfDays; $i++) {
                $date = sprintf('%04d-%02d-%02d', $currentYear, $currentMonth, $i) . ' 00:00:00';
                $date_only = date('Y-m-d', strtotime($date));

                if (isset($attendanceHash[$empId][$date_only])) {
                    $attendanceData = $attendanceHash[$empId][$date_only];
                    $employee['attendance_data'][] = [
                        'id' => $attendanceData->id,
                        'date_time' => $attendanceData->date_time,
                        'status' => $attendanceData->status
                    ];
                } else {
                    $employee['attendance_data'][] = [
                        'id' => null,
                        'date_time' => $date,
                        'status' => null
                    ];
                }
            }
        }
        $context = [
            "attendances" => $attendances,
            "departments" => $departments,
            "employees" => $employees,
            "Days" => $numberOfDays,
            'emp_Attendances' => $emp_Attendances
        ];
        return view('hrmanagement::attendance.all_attendance', $context);
    }
    // Add

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeAttendance(Request $request)
    {
        abort_if(Gate::denies('add_attendence'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $date = $request->get("date");
            $status = $request->get("status");
            $department = $request->get('departments');

            // To check if user has selected all or not
            $selectedEmployees = $request->input('employees');
            if (in_array('all', $selectedEmployees))
            {
                if ($department) {
                    // Scenario: Emp-->all,  Dpt-->selected
                    $employees = $this->employeeDepartmentRepository->getEmployeesByDepartment($department);
                    foreach ($employees as $employee) {
                        if ($this->attendanceRepository->existsAttendance(employeeId: $employee->employee->id, date: $date)) {
                            continue;
                        }
                        $this->attendanceRepository->createAttendance(dateTime: $date, status: $status, employeeId: $employee->employee->id);
                    }
                } else {
                    // Scenario: Emp-->all,  Dpt-->Null
                    $employees = $this->employeesRepository->getEmployees();
                    foreach ($employees as $employee) {
                        if ($this->attendanceRepository->existsAttendance(employeeId: $employee->id, date: $date)) {
                            continue;
                        }
                        $this->attendanceRepository->createAttendance(dateTime: $date, status: $status, employeeId: $employee->id);
                    }
                }
            }
            else {
                $employees = $request->get("employees");
                foreach ($employees as $employee) {
                    if ($this->attendanceRepository->existsAttendance(employeeId: $employee, date: $date)) {
                        continue;
                    }
                    $this->attendanceRepository->createAttendance(dateTime: $date, status: $status, employeeId: $employee);
                }
            }
            return redirect()->route("hr_attendance")->with("success", "Attendance marked successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            error_log('error : ' . $exception);
            return redirect()->route("hr_attendance")->with("error", "Something went wrong!Contact support");
        }
    }
    // Edit

    /**
     * Show the specified resource.
     * @param int $id
     */
    public function showAttendanceByEmployee($id)
    {

        return view('hrmanagement::show');
    }

    public function showAttendanceByFilter(Request $request)
    {
        try {

        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->to("hr_attendance")->with("error", "Something went wrong!Contact support");
        }
    }

    public function showAttendanceByDate(Request $request)
    {
        try {
            $month = $request->get("month");
            $attendances = $this->attendanceRepository->getAttendanceByMonth($month);
            return view('hrmanagement::attendance.all_attendance', ["attendances" => $attendances]);
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->to("hr_attendance")->with("error", "Something went wrong!Contact support");
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editAttendance($id)
    {
        abort_if(Gate::denies('edit_attendence'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return response()->json(["attendance" => $this->attendanceRepository->getAttendanceByEmployee($id)]);
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(["attendance" => null], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function updateAttendance(Request $request, $id)
    {
        abort_if(Gate::denies('update_attendence'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $employee = $request->get("employee");
            $date = $request->get("date");
            $status = $request->get("status");
            $this->attendanceRepository->updateAttendance(id: $id, status: $status, employeeId: $employee, dateTime: $date);
            return redirect()->route("hr_attendance")->with("success", "Attendance updated successfully");

        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->to("hr_attendance")->with("error", "Something went wrong!Contact support");
        }
    }
    // Delete

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyAttendance($id)
    {
        abort_if(Gate::denies('delete_attendence'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->attendanceRepository->deleteAttendance(id: $id);
            return redirect()->route("hr_attendance")->with("success", "Attendance delete successfully");

        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->to("hr_attendance")->with("error", "Something went wrong!Contact support");
        }
    }

    // Ajax or Other Calls
    public function getEmployees(Request $request)
    {
        try {
            $department_id = $request->get('department_id');

            if ($department_id == "") {
                $employees = $this->employeesRepository->getEmployees();

                $data = [
                    'id' => 'empty',
                    'employees' => $employees
                ];
            } else {
                $employees = $this->employeeDepartmentRepository->getEmployeesByDepartment($department_id);
                $data = [
                    'id' => 'not-empty',
                    'employees' => $employees
                ];
            }
            return response()->json(["data" => $data], 200);
        } catch (Exception $exception) {
            return response()->json([], 400);
        }
    }


}
