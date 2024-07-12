<?php

namespace Modules\HRManagement\Http\Controllers\Timesheets;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Modules\HRManagement\Interfaces\TimesheetInterface;
use Symfony\Component\HttpFoundation\Response;
use function Termwind\render;

class TimesheetsController extends Controller
{

    //Meta Data
    private TimesheetInterface $timesheetsRepository;
    private EmployeesInterface $employeesRepository;

    public function __construct(TimesheetInterface $timesheetsRepository, EmployeesInterface $employeesRepository)
    {
        $this->timesheetsRepository = $timesheetsRepository;
        $this->employeesRepository = $employeesRepository;
    }

    // ALL

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function viewTimesheets()
    {
//        abort_if(Gate::denies('view_timesheet'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $timesheets = $this->timesheetsRepository->getTimesheets();
            $employees = $this->employeesRepository->getEmployees();

            return view('hrmanagement::timesheet.timesheet', ["timesheets" => $timesheets, "employees" => $employees]);
        } catch (Exception $exception) {
            Log::error($exception);
            error_log("Error in View Timesheet : " . $exception);
            return view('hrmanagement::timesheet.timesheet')->with('error', "Something went wrong");
        }

    }

    //Add

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeTimesheet(Request $request)
    {
        abort_if(Gate::denies('add_timesheet'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employee = $request->get('employee');
        $sheet_title = $request->get('sheet_title');
        $hours_worked = $request->get('hours_worked');
        $date = $request->get('date');
        $description = $request->get('description');
        if ($description == "") {
            $description = Null;
        }
        $status = "Pending";
        if ($request->get('status') != "") {
            $status = $request->get('status');
        }
        try {
            $this->timesheetsRepository->createTimesheet(sheetTitle: $sheet_title, date: $date, employeeId: $employee, description: $description, hoursWorked: $hours_worked, status: $status);
            return redirect()->route('hr_timesheets')->with('success', "Timesheet added successfully");

        } catch (Exception $exception) {
            Log::error($exception);
            error_log("Error in store timesheet : " . $exception);
            return redirect()->route('hr_timesheets')->with('error', 'Something went wrong');
        }

    }

    //Edit
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editTimesheet($id)
    {
        abort_if(Gate::denies('edit_timesheet'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $employees = $this->employeesRepository->getEmployees();
            $timesheet = $this->timesheetsRepository->getTimesheet($id);
            return response()->json(["timesheet" => $timesheet, "employees" => $employees], 200);
        } catch (Exception $exception) {
            Log::error($exception);
            error_log("Error in edit timesheet ajax call : " . $exception);
            return response()->json(["timesheet" => Null], 400);
        }
    }
    /**
     * Show the specified resource.
     * @param Request $request
     */
    public function updateTimesheet(Request $request)
    {
        abort_if(Gate::denies('update_timesheet'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       try{
           $id = $request->get('id');
           $employee = $request->get('edit_employee');
           $status = $request->get('edit_status');
           $date = $request->get('edit_date');
           $hours_worked = $request->get('edit_hours_worked');
           $sheet_title = $request->get('edit_sheet_title');
           $description = $request->get('edit_description');
           $this->timesheetsRepository->updateTimesheet(id: $id, sheetTitle: $sheet_title, date: $date, employeeId: $employee, description: $description, hoursWorked: $hours_worked, status: $status);

           return redirect()->route('hr_timesheets')->with('success',"Changes saved successfully");
       }
       catch (Exception $exception)
       {
           Log::error($exception);
           error_log("Error in update timesheet :".$exception);
           return redirect()->route('hr_timesheets')->with('error',"Something went wrong");
       }

    }

    //Delete
    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyTimesheet($id)
    {
        abort_if(Gate::denies('delete_timesheet'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->timesheetsRepository->deleteTimesheet($id);
            return redirect()->route('hr_timesheets')->with('success', "Timesheet deleted successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            error_log("Error in delete timesheet : " . $exception);
            return redirect()->route('hr_timesheets')->with('error', "Something went wrong");
        }
    }

}
