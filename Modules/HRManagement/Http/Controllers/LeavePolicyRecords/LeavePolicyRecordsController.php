<?php

namespace Modules\HRManagement\Http\Controllers\LeavePolicyRecords;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Interfaces\LeavePolicyRecordInterface;
use Modules\HRManagement\Interfaces\LeaveTypesInterface;
use Symfony\Component\HttpFoundation\Response;

class LeavePolicyRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    private LeavePolicyRecordInterface $leavePolicyRecord;
    private LeaveTypesInterface $leaveTypes;

    /**
     * @param LeavePolicyRecordInterface $leavePolicyRecord
     * @param LeaveTypesInterface $leaveTypes
     */
    public function __construct(LeavePolicyRecordInterface $leavePolicyRecord, LeaveTypesInterface $leaveTypes)
    {
        $this->leavePolicyRecord = $leavePolicyRecord;
        $this->leaveTypes = $leaveTypes;
    }

    public function viewLeavePolicyRecord($id)
    {
        abort_if(Gate::denies('view_leave_policy_record'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $leaveTypes = $this->leaveTypes->getLeaveTypes();
        $policyRecord = $this->leavePolicyRecord->getLeavePolicyRecord($id);
        return view('hrmanagement::leave_policy.leave_policy_record', ['policyRecord' => $policyRecord, 'leaveTypes' => $leaveTypes]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hrmanagement::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeLeavePolicyRecord(Request $request, $id)
    {
        abort_if(Gate::denies('store_leave_policy_record'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {

            $leave_policy_id = $id;
            $leave_type_id = $request->get('leave_type_id');

            $allowed = $request->get('allowed');
            $impact_on_pay = $request->get('impact_on_pay');

            $leave_policy = $this->leavePolicyRecord->existsLeavePolicyByPolicyIDLeaveTypeID(policyID: $leave_policy_id, leaveTypeID: $leave_type_id);
            if ($leave_policy) {
                return redirect()->route("leave_policy_record", ["id" => $id])->with("error", "This leave type already exists.");
            }

            $this->leavePolicyRecord->createLeavePolicyRecord($leave_policy_id, $leave_type_id, $allowed, $impact_on_pay);
            return redirect()->route("leave_policy_record", ["id" => $id])->with("success", "Policy Record added successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("leave_policy_record", ["id" => $id])->with("error", "Something went wrong! Contact support");
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('hrmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editLeavePolicyRecord($record_id)
    {
        abort_if(Gate::denies('edit_leave_policy_record'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $policy_record = $this->leavePolicyRecord->getLeavePolicyRecordById($record_id);
            return response()->json(["policy_record" => $policy_record], 200);
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(["policyRecord" => null], 202);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function updateLeavePolicyRecord(Request $request, $id)
    {
        abort_if(Gate::denies('update_leave_policy_record'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $leave_policy_id = null;
            $leave_type_id = $request->get('leave_type_id');
            $allowed = $request->get('allowed');
            $impact_on_pay = $request->get('impact_on_pay');
            $this->leavePolicyRecord->updateLeavePolicyRecord($request->get('id'), $leave_policy_id, $leave_type_id, $allowed, $impact_on_pay);
            return redirect()->route("leave_policy_record", ['id' => $id])->with('success', 'Leave policy record updated successfully');
        } catch (Exception $exception) {
            log::error($exception);
            return redirect()->route("leave_policy_record", ['id' => $id])->with("error", "Something went wrong! Contact Support");
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyLeavePolicyRecord($record_id, $id)
    {
        abort_if(Gate::denies('delete_leave_policy_record'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->leavePolicyRecord->deleteLeavePolicyRecord($id);
            return redirect()->route("leave_policy_record", ['id' => $record_id])->with('success', "Leave policy record deleted successfully");
        } catch (Exception $exception) {
            log::error($exception);
            return redirect()->route("leave_policy_record", ['id' => $record_id])->with('error', "Something went wrong! Contact Support");
        }
    }
}
