<?php

namespace Modules\HRManagement\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\HRManagement\Entities\Payroll;
use Modules\HRManagement\Interfaces\PayrollInterface;

class PayrollRepository implements PayrollInterface
{

    /**
     * @param $payRate
     * @param $deductions
     * @param $bonus
     * @param $hoursWorked
     * @param $grossPay
     * @param $taxWithheld
     * @param $netPay
     * @param $startDate
     * @param $endDate
     * @param $employeeId
     * @return mixed
     */
    public function createPayroll($payRate, $deductions, $bonus, $hoursWorked, $grossPay, $taxWithheld, $netPay, $startDate, $endDate, $employeeId)
    {
        $payroll = new Payroll([
            "pay_rate"=>$payRate,
            "deductions"=>$deductions,
            "bonus"=>$bonus,
            "hours_worked"=>$hoursWorked,
            "gross_pay"=>$grossPay,
            "tax_withheld"=>$taxWithheld,
            "net_pay"=>$netPay,
            "start_date"=>$startDate,
            "end_date"=>$endDate,
            "employee_id"=>$employeeId,
        ]);

        return $payroll->save();
    }

    /**
     * @param $id
     * @param $payRate
     * @param $deductions
     * @param $bonus
     * @param $hoursWorked
     * @param $grossPay
     * @param $taxWithheld
     * @param $netPay
     * @param $startDate
     * @param $endDate
     * @param $employeeId
     * @return mixed
     */
    public function updatePayroll($id, $payRate = null, $deductions = null, $bonus = null, $hoursWorked = null, $grossPay = null,
                                  $taxWithheld = null, $netPay = null, $startDate = null, $endDate = null, $employeeId = null)
    {
        $payroll = Payroll::find($id);
        if ($payRate){
            $payroll->pay_rate = $payRate;
        }
        if ($deductions){
            $payroll->deductions = $deductions;
        }
        if ($bonus){
            $payroll->bonus = $bonus;
        }
        if ($hoursWorked){
            $payroll->hours_worked = $hoursWorked;
        }
        if ($grossPay){
            $payroll->gross_pay = $grossPay;
        }
        if ($taxWithheld){
            $payroll->tax_withheld = $taxWithheld;
        }
        if ($netPay){
            $payroll->net_pay = $netPay;
        }
        if ($startDate){
            $payroll->start_date = $startDate;
        }
        if ($endDate){
            $payroll->end_date = $endDate;
        }
        if ($employeeId){
            $payroll->employee_id = $employeeId;
        }

        return $payroll->save();
    }

    /**
     * @return mixed
     */
    public function getPayrolls()
    {
       return Payroll::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPayroll($id)
    {
        return Payroll::find($id);
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getPayrollByEmployee($employeeId)
    {
       return Payroll::where(["employee_id"=>$employeeId])->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deletePayroll($id)
    {
        return Payroll::where(["id"=>$id])->delete();
    }

    /**
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public function getPayrollByCustomFilter($startDate, $endDate)
    {
       return Payroll::where(["start_date"=>$startDate, "end_date"=>$endDate])->get();
    }
}
