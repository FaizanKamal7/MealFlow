<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\Deductions;
use Modules\HRManagement\Interfaces\DeductionInterface;
use Modules\HRManagement\Interfaces\DesignationInterface;

class DeductionsRepository implements DeductionInterface
{

    /**
     * @param $amount
     * @param $employeeId
     * @param $description
     * @param $code
     * @param $date
     * @param $deducted
     * @param $status
     * @return mixed
     */
    public function createDeduction($amount, $employeeId, $description = null, $code = null, $date = null, $deducted = false, $status = "Pending")
    {
        $deduction = new Deductions([
            "amount" => $amount,
            "description" => $description,
            "code" => $code,
            "date" => $date,
            "deducted" => $deducted,
            "status" => $status,
            "employee_id" => $employeeId,
        ]);

        return $deduction->save();
    }

    public function approveDeduction($id)
    {
        Deductions::where(['id' => $id])->update(["status" => "Approved"]);
    }

    public function rejectDeduction($id)
    {
        Deductions::where(['id' => $id])->update(["status" => "Pending"]);
    }

    public function deductDeduction($id)
    {
        Deductions::where(['id' => $id])->update(["deducted" => 1]);
    }


    /**
     * @param $id
     * @param $amount
     * @param $employeeId
     * @param $description
     * @param $code
     * @param $date
     * @param $deducted
     * @param $status
     * @return mixed
     */
    public function updateDeduction($id, $amount = null, $employeeId = null, $description = null, $code = null, $date = null, $deducted = false, $status = null)
    {
        $deduction = Deductions::find($id);
        $deduction->description = $description;
        $deduction->code = $code;
        $deduction->deducted = $deducted;
        $deduction->status = $status;
        if ($amount) {
            $deduction->amount = $amount;
        }
        if ($employeeId) {
            $deduction->employee_id = $employeeId;
        }
        if ($date) {
            $deduction->date = $date;
        }
        return $deduction->save();
    }

    /**
     * @return mixed
     */
    public function getDeductions()
    {
        return Deductions::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDeduction($id)
    {
        return Deductions::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteDeduction($id)
    {
        return Deductions::where(["id" => $id])->delete();
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getDeductionsByEmployee($employeeId)
    {
        return Deductions::where(["employee_id" => $employeeId])->get();
    }

    /**
     * @param $amount
     * @param $employeeId
     * @param $date
     * @param $deducted
     * @param $status
     * @param $fromDate
     * @param $toDate
     * @return mixed
     */
    public function getDeductionsByCustomFilter($amount = null, $employeeId = null, $date = null, $deducted = false, $status = null, $fromDate = null, $toDate = null)
    {
        // TODO: Implement getDeductionsByCustomFilter() method.
    }
}
