<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\ExpenseReclaims;
use Modules\HRManagement\Interfaces\ExpenseReclaimInterface;

class ExpenseReclaimsRepository implements ExpenseReclaimInterface
{

    /**
     * @param $title
     * @param $currency
     * @param $exchangeRate
     * @param $amount
     * @param $purchaseDate
     * @param $category
     * @param $invoice
     * @param $purchasedFrom
     * @param $entryDate
     * @param $status
     * @param $resolutionDate
     * @param $notes
     * @param $employeeId
     * @return mixed
     */
    public function createExpenseReclaim($title, $currency, $exchangeRate, $amount, $purchaseDate, $category = null, $invoice = null, $purchasedFrom = null, $entryDate = null, $status = "pending", $resolutionDate = null, $notes = null, $employeeId = null)
    {
        $expenseReclaim = new ExpenseReclaims([
            "title"=>$title,
            "currency"=>$currency,
            "exchange_rate"=>$exchangeRate,
            "amount"=>$amount,
            "purchase_date"=>$purchaseDate,
            "category"=>$category,
            "invoice"=>$invoice,
            "purchase_from"=>$purchasedFrom,
            "entry_date"=>$entryDate,
            "status"=>$status,
            "resolution_date"=>$resolutionDate,
            "notes"=>$notes,
            "employee_id"=>$employeeId,

        ]);

        return $expenseReclaim->save();
    }

    /**
     * @param $id
     * @param $title
     * @param $currency
     * @param $exchangeRate
     * @param $amount
     * @param $purchaseDate
     * @param $category
     * @param $invoice
     * @param $purchasedFrom
     * @param $entryDate
     * @param $status
     * @param $resolutionDate
     * @param $notes
     * @param $employeeId
     * @return mixed
     */
    public function updateExpenseReclaim($id, $title = null, $currency = null, $exchangeRate = null, $amount = null, $purchaseDate = null,
                                         $category = null, $invoice = null, $purchasedFrom = null, $entryDate = null, $status = "pending",
                                         $resolutionDate = null, $notes = null, $employeeId = null)
    {
        $expenseReclaim  = ExpenseReclaims::find($id);

        $expenseReclaim->category = $category;
        $expenseReclaim->purchase_from = $purchasedFrom;
        $expenseReclaim->notes = $notes;
        $expenseReclaim->resolution_date = $resolutionDate;
        $expenseReclaim->entry_date = $entryDate;

        if ($title){
            $expenseReclaim->title = $title;
        }
        if ($currency){
            $expenseReclaim->currency = $currency;
        }
        if ($exchangeRate){
            $expenseReclaim->exchange_rate = $exchangeRate;
        }
        if ($amount){
            $expenseReclaim->amount=$amount;
        }
        if ($purchaseDate){
            $expenseReclaim->purchase_date = $purchaseDate;
        }
        if ($invoice){
            $expenseReclaim->invoice = $invoice;
        }
        if ($status){
            $expenseReclaim->status = $status;
        }
        if ($employeeId){
            $expenseReclaim->employee_id = $employeeId;
        }
        return $expenseReclaim->save();
    }

    /**
     * @return mixed
     */
    public function getExpenseReclaims()
    {
        return ExpenseReclaims::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getExpenseReclaim($id)
    {
        return ExpenseReclaims::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteExpenseReclaim($id)
    {
        return ExpenseReclaims::where(["id"=>$id])->delete();
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getExpenseReclaimByEmployee($employeeId)
    {
        return ExpenseReclaims::where(["employee_id"=>$employeeId])->get();
    }
}
