<?php

namespace Modules\HRManagement\Http\Controllers\LeavePolicy;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Http\Controllers\LeavePolicyRecords\LeavePolicyRecordsController;
use Modules\HRManagement\Interfaces\LeavePolicyInterface;
use Modules\HRManagement\Interfaces\LeavePolicyRecordInterface;
use Modules\HRManagement\Interfaces\LeaveTypesInterface;
use Symfony\Component\HttpFoundation\Response;

class LeavePolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private LeavePolicyInterface $leavePolicy;
    private LeaveTypesInterface $leaveTypes;

    private LeavePolicyRecordInterface $leavePolicyRecord;

    /**
     * @param LeavePolicyInterface $leavePolicy
     * @param LeaveTypesInterface $leaveTypes
     */
    public function __construct(LeavePolicyInterface $leavePolicy, LeaveTypesInterface $leaveTypes , LeavePolicyRecordInterface $leavePolicyRecord)
    {
        $this->leavePolicy = $leavePolicy;
        $this->leaveTypes = $leaveTypes;
        $this->leavePolicyRecord =$leavePolicyRecord;
    }


    public function viewLeavePolicies()
    {
        abort_if(Gate::denies('view_leave_policy'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $leave_policy = $this->leavePolicy->getLeavePolicies();
        return view('hrmanagement::leave_policy.policies',['leave_policy'=>$leave_policy]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createLeavePolicy()
    {
        abort_if(Gate::denies('add_leave_policy'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $leave_types = $this->leaveTypes->getLeaveTypes();
        return view('hrmanagement::leave_policy.add_policy',['leave_types'=>$leave_types]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request

     */
    public function storeLeavePolicy(Request $request)
    {

        try{
            $policy_name = $request->get('policy_name');
            $description = $request->get('description');
            $leave_policy = $this->leavePolicy->createLeavePolicy($policy_name, $description);

            $leaveTypeIds = [];
            foreach ($request->get("kt_docs_repeater_basic") as $repeater)
            {
                $leave_type = $repeater['leave_type_id'];
                if (in_array($leave_type, $leaveTypeIds)) {
                    continue;
                }
                $leaveTypeIds[] = $leave_type;
                $allowed = $repeater['allowed'];
                $impact_on_pay = $repeater['impact_on_pay'];
                $this->leavePolicyRecord->createLeavePolicyRecord($leave_policy->id, $leave_type, $allowed, $impact_on_pay);
            }

            return redirect()->route('leave_policy')->with("success", "Policy added successfully");
        }
        catch(Exception $exception)
        {
            log::error($exception);
            error_log("error in create".$exception);
            return redirect()->route('leave_policy')->with("error", "Something went wrong! Contact support");

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
    public function editLeavePolicy($id)
    {
        abort_if(Gate::denies('edit_leave_policy'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $policy= $this->leavePolicy->getLeavePolicy($id);
            return response()->json(["policy"=>$policy], 200);
        }
        catch (Exception $exception){
            Log::error($exception);
            return response()->json(["policy"=>null], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id

     */
    public function updateLeavePolicy(Request $request)
    {
        abort_if(Gate::denies('update_leave_policy'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $name = $request->get("policy_name");
            $description = $request->get("description");
            $this->leavePolicy->updateLeavePolicy($request->get("id"), $name,$description);
            return redirect()->route("leave_policy")->with("success", "Leave policy updated successfully");
        }catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("leave_policy")->with("error", "Something went wrong! Contact support");
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id

     */
    public function destroyLeavePolicy($id)
    {
        abort_if(Gate::denies('delete_leave_policy'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->leavePolicy->deleteLeavePolicy($id);
            return redirect()->route("leave_policy")->with("success", "Leave policy deleted successfully");
        }catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("leave_policy")->with("error", "Something went wrong! Contact support");
        }
    }


}
