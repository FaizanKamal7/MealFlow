<?php

namespace Modules\HRManagement\Http\Controllers\LeaveTypes;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\HRManagement\Interfaces\LeaveTypesInterface;
use Symfony\Component\HttpFoundation\Response;

class LeaveTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private LeaveTypesInterface $leaveTypes;

    /**
     * @param LeaveTypesInterface $leaveTypes
     */
    public function __construct(LeaveTypesInterface $leaveTypes)
    {
        $this->leaveTypes = $leaveTypes;
    }


    public function viewLeaveTypes()
    {
        abort_if(Gate::denies('view_leave_type'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $leave_types = $this->leaveTypes->getLeaveTypes();
        return view('hrmanagement::leave_types.leave_types',['leave_types'=>$leave_types]);
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
    public function storeLeaveTypes(Request $request)
    {
        abort_if(Gate::denies('add_leave_type'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $name = $request->get("name");
            $color = $request->get("color");

          $this->leaveTypes->createLeaveType($name,$color);

            return redirect()->route("hr_leave_types")->with("success", "Leave type added successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_leave_types")->with("error", "Something went wrong! Contact support");
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
     * @return Renderable
     */
    public function editLeaveTypes($id)
    {
        abort_if(Gate::denies('edit_leave_type'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $leaveType = $this->leaveTypes->getLeaveType($id);
            return response()->json(["leaveType"=>$leaveType], 200);
        }
        catch (Exception $exception){
            Log::error($exception);
            return response()->json(["event"=>null], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateLeaveTypes(Request $request)
    {
        abort_if(Gate::denies('update_leave_type'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $name = $request->get("name");
            $color = $request->get("color");
            $this->leaveTypes->updateLeaveType($request->get("id"), $name, $color);
            return redirect()->route("hr_leave_types")->with("success", "Leave types updated successfully");
        }catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_leave_types")->with("error", "Something went wrong! Contact support");
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroyLeaveTypes($id)
    {
        abort_if(Gate::denies('delete_leave_type'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->leaveTypes->deleteLeaveType($id);
            return redirect()->route("hr_leave_types")->with("success", "Leave type deleted successfully");
        }catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_leave_types")->with("error", "Something went wrong! Contact support");
        }
    }
}
