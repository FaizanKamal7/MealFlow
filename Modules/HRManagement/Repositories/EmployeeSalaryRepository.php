<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\EmployeeSalary;
use Modules\HRManagement\Interfaces\EmployeeSalaryInterface;

class EmployeeSalaryRepository implements EmployeeSalaryInterface
{

    /**
     * @param $basicSalary
     * @param $cycle
     * @param $employeeId
     * @param $taxable
     * @param $taxId
     * @return mixed
     */
    public function createEmployeeSalary($basicSalary, $cycle, $employeeId, $taxable, $taxId)
    {
        $employeeSalary = new EmployeeSalary([
            "basic_salary"=>$basicSalary,
            "cycle"=>$cycle,
            "employee_id"=>$employeeId,
            "taxable"=>$taxable,
            "tax_id"=>$taxId
        ]);

        return $employeeSalary->save();
    }

    /**
     * @param $id
     * @param $basicSalary
     * @param $cycle
     * @param $employeeId
     * @param $taxable
     * @param $taxId
     * @return mixed
     */
    public function updateEmployeeSalary($id, $basicSalary = null, $cycle = null, $employeeId = null, $taxable = null, $taxId = null)
    {
        $employeeSalary= EmployeeSalary::find($id);
        if ($basicSalary){
            $employeeSalary->basic_salary = $basicSalary;
        }
        if ($cycle){
            $employeeSalary->cycle = $cycle;
        }
        if ($employeeId){
            $employeeSalary->employee_id = $employeeId;
        }
        if ($taxable){
            $employeeSalary->taxable = $taxable;
        }
        if ($taxId){
            $employeeSalary->tax_id = $taxId;
        }

        return $employeeSalary->save();
    }

    /**
     * @return mixed
     */
    public function getAllEmployeeSalary()
    {
        return EmployeeSalary::all();
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getEmployeeSalary($employeeId)
    {
        return EmployeeSalary::where(["employee_id"=>$employeeId])->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEmployeeSalarySingle($id)
    {
        return EmployeeSalary::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteEmployeeSalary($id)
    {
        return EmployeeSalary::where(["id"=>$id])->delete();
    }
}
