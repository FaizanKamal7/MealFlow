<?php

namespace Modules\HRManagement\Http\Controllers\LeaveApplications;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Entities\Employees;
use Modules\HRManagement\Entities\LeavePolicyRecords;
use Modules\HRManagement\Http\Helper\Helper;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Modules\HRManagement\Interfaces\LeaveApplicationInterface;
use Modules\HRManagement\Interfaces\LeavePolicyRecordInterface;
use Modules\HRManagement\Interfaces\LeaveTypesInterface;
use Symfony\Component\HttpFoundation\Response;

class LeaveApplicationsController extends Controller
{
    // Meta Data

    private EmployeesInterface $employeesRepository;
    private LeavePolicyRecordInterface $leavePolicyRecord;
    private LeaveApplicationInterface $leaveApplication;
    private LeaveTypesInterface $leaveTypesRepository;

    /**
     * @param EmployeesInterface $employeesRepository
     * @param LeavePolicyRecordInterface $leavePolicyRecord
     * @param LeaveApplicationInterface $leaveApplication
     */
    public function __construct(LeaveTypesInterface $leaveTypesRepository, EmployeesInterface $employeesRepository, LeavePolicyRecordInterface $leavePolicyRecord, LeaveApplicationInterface $leaveApplication)
    {
        $this->employeesRepository = $employeesRepository;
        $this->leavePolicyRecord = $leavePolicyRecord;
        $this->leaveApplication = $leaveApplication;
        $this->leaveTypesRepository = $leaveTypesRepository;
    }

    // View
    public function viewLeaveApplications()
    {
        abort_if(Gate::denies('view_leave_application'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $leave_applications = $this->leaveApplication->getLeaveApplications();
        return view('hrmanagement::leaves.leaves', ["leave_applications" => $leave_applications]);
    }

    // Add
    public function viewAddLeaveApplication()
    {
        abort_if(Gate::denies('add_leave_application'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employees = $this->employeesRepository->getEmployees();
        return view('hrmanagement::leaves.add_leaves', ["employees" => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeLeaveApplication(Request $request)
    {
        try {
            $description = null;
            $attachment = null;
            $consumed = 0;
            $status = "pending";
            $employee_id = $request->get('employee_id');
            $leave_policy_id = $request->get('leave_type_id');
            $duration = $request->get('duration');
            $start_date = $request->get('start_date');

            $end_date = null;
            if ($request->filled('end_date')) {
                $end_date = $request->get('end_date');
            }
            $impact_on_pay = $request->get('impact_on_pay');

            if ($duration == 'Half Day') {
                $end_date = $start_date;
                $consumed = 0.5;
                $impact_on_pay = 0.5 * $impact_on_pay;
            } else if ($duration == 'Full Day') {
                $end_date = $start_date;
                $consumed = 1;
            } else if ($duration == 'Multiple Day') {
                $consumed = (\Carbon\Carbon::parse($start_date)->diffInDays(\Carbon\Carbon::parse($end_date))) + 1;
                $impact_on_pay = $consumed * $impact_on_pay;

            } else {
                return redirect()->route("hr_leave_applications")->with("error", "Something went wrong! Contact Support");
            }
            $this->leaveApplication->createLeaveApplication($duration, $start_date, $end_date, $leave_policy_id, $employee_id, $status, $description, $attachment, $consumed, $impact_on_pay);
            return redirect()->route("hr_leave_applications")->with("success", "Leave application added successfully");

        } catch (Exception $exception) {
            log::error($exception);
            return redirect()->route("hr_leave_applications")->with("error", "Something went wrong! Contact Support");

        }
    }

    // Edit

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editLeaveApplication($id)
    {
        abort_if(Gate::denies('edit_leave_application'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $leave = $this->leaveApplication->getLeaveApplication($id);
            $employee = $this->employeesRepository->getEmployee($leave->employee_id);
            $policy_records = $this->leavePolicyRecord->getLeavePolicyRecord($employee->leave_policy_id);
            $employees = $this->employeesRepository->getEmployees();
            return view('hrmanagement::leaves.edit_leaves', ["leave" => $leave, "employees" => $employees, "policy_records" => $policy_records]);
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('hr_leave_applications')->with('error', "Something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function updateLeaveApplication(Request $request, $id)
    {
        abort_if(Gate::denies('update_leave_application'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $description = null;
            $attachment = null;
            $consumed = 0;
            $status = "pending";
            $employee_id = $request->get('employee_id');
            $leave_policy_id = $request->get('leave_type_id');
            $duration = $request->get('duration');
            $start_date = $request->get('start_date');
            $end_date = null;
            if ($request->filled('end_date')) {
                $end_date = $request->get('end_date');
            }
            $impact_on_pay = $request->get('impact_on_pay');
            $this->leaveApplication->updateLeaveApplication(id: $id, duration: $duration, startDate: $start_date, endDate: $end_date, leavePolicyId: $leave_policy_id, employeeId: $employee_id, status: $status, description: $description, attachment: $attachment, consumed: $consumed, impactOnPay: $impact_on_pay);
            return redirect()->route("hr_leave_applications")->with("success", "Leave application Updated successfully");

        } catch (Exception $exception) {
            log::error($exception);
            return redirect()->route('hr_leave_applications')->with('error', "Something went wrong");

        }
    }

    // Delete

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyLeaveApplication($id)
    {
        abort_if(Gate::denies('delete_leave_application'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->leaveApplication->deleteLeaveApplication($id);
            return redirect()->route("hr_leave_applications")->with("success", "Leave application deleted successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("hr_leave_applications")->with("error", "Something went wrong! Contact support");
        }
    }

    // Ajax Calls Functions
    public function getEmpPolicyData(Request $request)
    {
        try {
            $employee_id = $request->get('employee_id');
            $employee = $this->employeesRepository->getEmployee($employee_id);
            if (!$employee->leave_policy_id) {
                return response()->json(['leave_policy' => null], 400);
            }
            $leave_policy = $this->leavePolicyRecord->getLeavePolicyRecord($employee->leave_policy_id);
            return response()->json(['leave_policy' => $leave_policy], 200);
        } catch (Exception $exception) {
            return response()->json(['leave_policy' => null], 400);
        }
    }

    public function getEmpLeaveCalculations(Request $request)
    {
        try {

            $policy_record_id = $request->get('policy_record_id');
            $employee_id = $request->get('employee_id');
            $leaves = $this->leaveApplication->getLeaveByEmployeeAndPolicyRecord(employeeId: $employee_id, policyRecordId: $policy_record_id);
            $consumed = 0;
            foreach ($leaves as $leave) {
                if ($leave->status=="approved"){
                    $consumed = $consumed + $leave->consumed;
                }
            }
            return response()->json(["consumed" => $consumed], 200);
        } catch (Exception $exception) {
            return response()->json(["consumed" => null], 400);
        }
    }
}
