<?php

namespace Modules\HRManagement\Http\Controllers\Overtime;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Modules\HRManagement\Interfaces\OvertimeInterface;
use Modules\HRManagement\Interfaces\TimesheetInterface;
use Symfony\Component\HttpFoundation\Response;

class OvertimeController extends Controller
{
    //Meta Data
    private OvertimeInterface $overtimesRepository;
    private TimesheetInterface $timesheetsRepository;
    private EmployeesInterface $employeesRepository;

    public function __construct(OvertimeInterface $overtimesRepository, TimesheetInterface $timesheetsRepository, EmployeesInterface $employeesRepository)
    {
        $this->overtimesRepository = $overtimesRepository;
        $this->employeesRepository = $employeesRepository;
        $this->timesheetsRepository = $timesheetsRepository;

    }

    // View

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function viewOvertimes()
    {
        abort_if(Gate::denies('view_overtime'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $overtimes = $this->overtimesRepository->getOvertimes();
            $employees = $this->employeesRepository->getEmployees();
            $timesheets = $this->timesheetsRepository->getTimesheets();
            return view('hrmanagement::overtime.overtime', ["overtimes" => $overtimes, "employees" => $employees, "timesheets" => $timesheets]);
        } catch (Exception $exception) {
            Log::error($exception);
            return view('hrmanagement::overtime.overtime');
        }
    }

    // Add

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeOvertime(Request $request)
    {
        abort_if(Gate::denies('add_overtime'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $timesheet = $request->get('timesheet');
            $description = $request->get('description');
            $hours = $request->get('hours');
            $pay_adjustment = $request->get('pay_adjustment');
            $date = $request->get('date');
            $title = $request->get('title');
            $status = "Pending";
            if ($request->get('status') != "") {
                $status = $request->get('status');
            }
            $this->overtimesRepository->createOvertime(title: $title, date: $date, description: $description, payAdjustment: $pay_adjustment, hours: $hours, status: $status, timesheetId: $timesheet);
            return redirect()->route('hr_overtimes')->with('success' , "Overtime added successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('hr_overtimes')->with('error' , "Something went wrong");
        }
    }

    // Edit

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editOvertime($id)
    {
        abort_if(Gate::denies('edit_overtime'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $overtime = $this->overtimesRepository->getOvertime($id);
            $timesheets = $this->timesheetsRepository->getTimesheetByEmployee($overtime->timesheet->employee_id);
            $employee = $this->employeesRepository->getEmployee($overtime->timesheet->employee_id);
            return response()->json(["overtime" => $overtime, "timesheets" => $timesheets, "employee" => $employee], 200);
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(["overtime" => Null], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function updateOvertime(Request $request)
    {
        abort_if(Gate::denies('update_overtime'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            $id = $request->get('id');
            $timesheet = $request->get('edit_timesheet');
            $title = $request->get('edit_title');
            $description = $request->get('edit_description');
            $hours = $request->get('edit_hours');
            $date = $request->get('edit_date');
            $pay_adjustment = $request->get('edit_pay_adjustment');
            $status = $request->get('edit_status');
            $this->overtimesRepository->updateOvertime(id: $id, title: $title, date: $date, description: $description, payAdjustment: $pay_adjustment, hours: $hours, status: $status, timesheetId: $timesheet);
            return redirect()->route('hr_overtimes')->with('success',"Overtime updated successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route('hr_overtimes')->with('error',"Something went wrong");
        }
    }

    // Delete

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyOvertime($id)
    {
        abort_if(Gate::denies('delete_overtime'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->overtimesRepository->deleteOvertime($id);
            return redirect()->route('hr_overtimes')->with('success', "Overtime deleted successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('hr_overtimes')->with('error', "Something went wrong");
        }

    }

    //Ajax calls
    /**
     * Get Timesheets Based on Emp id
     * @param int $id
     */
    public function getTimesheets($id)
    {
        try {
            $timesheets = $this->timesheetsRepository->getTimesheetByEmployee($id);
            return response()->json(["timesheets" => $timesheets], 200);
        } catch (Exception $exception) {
            Log::error($exception);
            error_log("Error in Overtimes : getTimesheets " . $exception);
            return response()->json(["timesheets" => Null], 400);

        }
    }
}
