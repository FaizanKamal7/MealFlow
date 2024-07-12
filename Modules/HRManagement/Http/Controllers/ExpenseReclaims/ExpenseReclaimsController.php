<?php

namespace Modules\HRManagement\Http\Controllers\ExpenseReclaims;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Http\Helper\Helper;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Modules\HRManagement\Interfaces\ExpenseReclaimInterface;
use Symfony\Component\HttpFoundation\Response;


class ExpenseReclaimsController extends Controller
{
    // Meta Data
    private ExpenseReclaimInterface $expenseReclaimRepository;
    private EmployeesInterface $employeesRepository;

    /**
     * @param ExpenseReclaimInterface $expenseReclaimRepository
     */
    public function __construct(ExpenseReclaimInterface $expenseReclaimRepository, EmployeesInterface $employeesRepository)
    {
        $this->expenseReclaimRepository = $expenseReclaimRepository;
        $this->employeesRepository = $employeesRepository;
    }

    // View
    public function viewExpenseReclaims()
    {
        abort_if(Gate::denies('view_expense_reclaim'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {

            $expenseReclaims = $this->expenseReclaimRepository->getExpenseReclaims();
            return view('hrmanagement::expense_reclaim.expense_reclaims', ["expenseReclaims" => $expenseReclaims]);
        } catch (Exception $exception) {
            Log::error($exception);
            return view('hrmanagement::expense_reclaim.expense_reclaims')->with('error', "Something went wrong");
        }
    }

    // Add

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function addExpenseReclaimsView()
    {
        abort_if(Gate::denies('add_expense_reclaim'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $employees = $this->employeesRepository->getEmployees();
            return view('hrmanagement::expense_reclaim.add_expense_reclaim', ["employees" => $employees]);
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('hr_expense_recclaims')->with('error', "Something went wrong");
        }
    }

    public function storeExpenseReclaim(Request $request)
    {
        try {
            $title = $request->get("title");
            $currency = $request->get("currency");
            $exchange_rate = $request->get("exchange_rate");
            $amount = $request->get("amount");
            $purchase_date = $request->get("purchase_date");
            $category = $request->get("category");
            $invoice = null;
            $purchase_from = $request->get("purchase_from");
            $entry_date = $request->get("purchase_date");
            $status = $request->get("status");
            $resolution_date = $request->get("resolution_date");
            $notes = $request->get("notes");
            $employeeId = $request->get("employee_id");

            if ($file = $request->file("invoice")) {
                $helper = new Helper();
                $invoice = $helper->storeFile($file, "expense_reclaims");
            }

            $this->expenseReclaimRepository->createExpenseReclaim($title, $currency, $exchange_rate, $amount, $purchase_date, $category, $invoice, $purchase_from, $entry_date, $status, $resolution_date, $notes, $employeeId);
            return redirect()->route('hr_expense_reclaims')->with("success", "Expense Reclaims added successfully");
        } catch (Exception $exception) {
            log::error($exception);
            return redirect()->route('hr_expense_reclaims')->with("error", "Something went wrong! Contact support");

        }
    }

    // Edit

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editExpenseReclaim($id)
    {
        abort_if(Gate::denies('edit_expense_reclaim'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $employees = $this->employeesRepository->getEmployees();
            $expense_reclaim = $this->expenseReclaimRepository->getExpenseReclaim($id);
            return view('hrmanagement::expense_reclaim.edit_expense_reclaim', ["employees" => $employees, "expense_reclaim" => $expense_reclaim]);
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('hr_expense_reclaims')->with("error", "Something went wrong! Contact support");
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function updateExpenseReclaim(Request $request)
    {
        abort_if(Gate::denies('update_expense_reclaim'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $id = $request->get('id');

            $title = $request->get("title");
            $currency = $request->get("currency");
            $exchange_rate = $request->get("exchange_rate");
            $amount = $request->get("amount");
            $purchase_date = $request->get("purchase_date");
            $category = $request->get("category");
            $invoice = null;
            $purchase_from = $request->get("purchase_from");
            $entry_date = $request->get("purchase_date");
            $status = $request->get("status");
            $resolution_date = $request->get("resolution_date");
            $notes = $request->get("notes");
            $employeeId = $request->get("employee_id");
            if ($file = $request->file("invoice")) {
                $helper = new Helper();
                $invoice = $helper->storeFile($file, "expense_reclaims");
            }
            $this->expenseReclaimRepository->updateExpenseReclaim($id, $title, $currency, $exchange_rate, $amount, $purchase_date, $category, $invoice, $purchase_from, $entry_date, $status, $resolution_date, $notes, $employeeId, $invoice);

            return redirect()->route('hr_expense_reclaims')->with("success", "Expense Reclaims Updated successfully");
        } catch (Exception $exception) {
            log::error($exception);
            return redirect()->route('hr_expense_reclaims')->with("error", "Something went wrong! Contact support");

        }
    }
    // Delete
    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyExpenseReclaim($id)
    {
        abort_if(Gate::denies('delete_expense_reclaim'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->expenseReclaimRepository->deleteExpenseReclaim($id);
            return redirect()->route("hr_expense_reclaims")->with("success", "Expense Reclaim deleted successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("hr_expense_reclaims")->with("error", "Something went wrong! Contact support");
        }
    }
}
