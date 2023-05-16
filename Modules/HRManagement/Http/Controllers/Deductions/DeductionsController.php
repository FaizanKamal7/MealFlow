<?php

namespace Modules\HRManagement\Http\Controllers\Deductions;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Interfaces\DeductionInterface;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Symfony\Component\HttpFoundation\Response;

class DeductionsController extends Controller
{
    // Meta Data

    private DeductionInterface $deductionRepository;
    private EmployeesInterface $employees;

    /**
     * @param DeductionInterface $deductionRepository
     * @param EmployeesInterface $employees
     */
    public function __construct(DeductionInterface $deductionRepository, EmployeesInterface $employees)
    {
        $this->deductionRepository = $deductionRepository;
        $this->employees = $employees;
    }

    // View

    /**
     * Display a listing of the resource.
     */
    public function viewDeductions(Request $request)
    {
        abort_if(Gate::denies('view_deduction'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $deductions = $this->deductionRepository->getDeductions();
        $employees = $this->employees->getEmployees();
        return view('hrmanagement::deductions.deductions', ["deductions" => $deductions, "employees" => $employees]);
    }
    // Add

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeDeduction(Request $request)
    {
        abort_if(Gate::denies('add_deduction'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $employee = $request->get("employee");
            $date = $request->get("date");
            $description = $request->get("description");
            $amount = $request->get("amount");
            $this->deductionRepository->createDeduction(amount: $amount, employeeId: $employee, description: $description, date: $date);
            return redirect()->route("hr_deductions")->with("success", "Deduction added successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("hr_deductions")->with("error", "Something went wrong! Contact support");
        }
    }
    // Edit

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editDeduction($id)
    {
        abort_if(Gate::denies('edit_deduction'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $deduction = $this->deductionRepository->getDeduction($id);
            $employees = $this->employees->getEmployees();
            return response()->json(["deduction" => $deduction, "employees" => $employees], 200);
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(["deduction" => null], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function updateDeduction(Request $request)
    {
        abort_if(Gate::denies('update_deduction'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $description = null;
            $status = "Pending";
            $deducted = false;
            $amount = $request->get("amount");
            $date = $request->get("date");

            if ($request->filled("description")) {
                $description = $request->get("description");
            }
            if ($request->filled("status")) {
                $status = "Approved";
            }
            if ($request->filled("deducted")) {
                $deducted = true;
            }
            $this->deductionRepository->updateDeduction(id: $request->get("id"), amount: $amount, description: $description, date: $date, deducted: $deducted, status: $status);
            return redirect()->route("hr_deductions")->with("success", "Deduction updated successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("hr_deductions")->with("error", "Something went wrong! Contact support");
        }

    }

    // Delete

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyDeduction($id)
    {
        abort_if(Gate::denies('delete_deduction'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->deductionRepository->deleteDeduction($id);
            return redirect()->route("hr_deductions")->with("success", "Deduction deleted successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("hr_deductions")->with("error", "Something went wrong! Contact support");
        }
    }

    // Ajax or Extra Calls
    public function updateStatus($id, $status)
    {
        try {
            $deduction = $this->deductionRepository->getDeduction($id);
            $this->deductionRepository->updateDeduction(id: $id,description: $deduction->description,code: $deduction->code,deducted: $deduction->deducted,status: $status);
            return redirect()->route("hr_deductions")->with("success", "Deduction status changed successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("hr_deductions")->with("error", "Something went wrong! Contact support");
        }
    }

    public function deductDeduction($id, $deducted)
    {
        try {
            $deduction = $this->deductionRepository->getDeduction($id);
            $this->deductionRepository->updateDeduction(id: $id,description: $deduction->description,code: $deduction->code,deducted: $deducted ,status: $deduction->status);
            if($deducted){
                return redirect()->route("hr_deductions")->with("success", "Payment deducted successfully");
            }
            else{
                return redirect()->route("hr_deductions")->with("success", "Payment changed to pending successfully");
            }

            } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("hr_deductions")->with("error", "Something went wrong! Contact support");
        }
    }

}
