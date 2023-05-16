<?php

namespace Modules\HRManagement\Http\Controllers\Designations;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Interfaces\DesignationInterface;
use Symfony\Component\HttpFoundation\Response;

class DesignationsController extends Controller
{
    private DesignationInterface $designationRepository;

    /**
     * @param DesignationInterface $designationRepository
     */
    public function __construct(DesignationInterface $designationRepository)
    {
        $this->designationRepository = $designationRepository;
    }

    // View
    /**
     * Display a listing of the resource.
     */
    public function viewDesignations()
    {
        abort_if(Gate::denies('view_designation'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{

            $designations = $this->designationRepository->getDesignations();
            return view('hrmanagement::designations.designations', ["designations"=>$designations]);
        }
        catch (Exception $exception){
            Log::error($exception);
            return view('hrmanagement::designations.designations')->with('error', "Something went wrong");
        }
    }
    // Add
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeDesignation(Request $request)
    {
        abort_if(Gate::denies('add_designation'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $name = $request->get("designation_name");
            $this->designationRepository->createDesignation($name);
            return redirect()->route("hr_designations")->with("success", "Designation added successfully");
        }catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_designations")->with("error", "Something went wrong! Contact support");
        }
    }

    // Edit
    /**
     * Show the form for editing the specified resource.
     * @param int $id

     */
    public function editDesignation($id)
    {
        abort_if(Gate::denies('edit_designation'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $designation = $this->designationRepository->getDesignation($id);
            return response()->json(["designation"=>$designation], 200);
        }
        catch (Exception $exception){
            Log::error($exception);
            return response()->json(["designation"=>null], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id

     */
    public function updateDesignation(Request $request)
    {
        abort_if(Gate::denies('update_designation'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $name = $request->get("designation_name");
            $id = $request->get("id");
            $this->designationRepository->updateDesignation(id: $id, name: $name);
            return redirect()->route("hr_designations")->with("success", "Designation updated successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_designations")->with("error", "Something went wrong! Contact support");
        }
    }

    // Delete
    /**
     * Remove the specified resource from storage.
     * @param int $id

     */
    public function destroyDesignation($id)
    {
        abort_if(Gate::denies('delete_designation'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->designationRepository->deleteDesignation($id);
            return redirect()->route("hr_designations")->with("success", "Designation deleted successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_designations")->with("error", "Something went wrong! Contact support");
        }
    }
}
