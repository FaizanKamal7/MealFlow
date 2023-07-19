<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\Banks;
use Modules\HRManagement\Entities\Employees;
use Modules\HRManagement\Entities\EmployeeSalary;
use Modules\HRManagement\Interfaces\EmployeesInterface;

class EmployeesRepository implements EmployeesInterface
{

    /**
     * @param $firstName
     * @param $lastName
     * @param $personalEmailAddress
     * @param $personalPhoneNumber
     * @param $companyEmailAddress
     * @param $companyPhoneNumber
     * @param $picture
     * @param $city
     * @param $country
     * @param $maritalStatus
     * @param $hireDate
     * @param $probationStartDate
     * @param $probationEndDate
     * @param $designationId
     * @param $leavePolicyId
     * @return mixed
     */
    public function createEmployee($firstName, $lastName, $personalEmailAddress, $personalPhoneNumber, $companyEmailAddress = null, $companyPhoneNumber = null,
                                   $picture = null, $city = null, $country = null, $maritalStatus = null, $hireDate = null,
                                   $probationStartDate = null, $probationEndDate = null, $designationId = null, $leavePolicyId = null, $employeeType = null, $contractStartDate = null, $contractEndDate = null, $userId = null)
    {
        $employee = new Employees([
            "first_name" => $firstName,
            "last_name" => $lastName,
            "personal_email_address" => $personalEmailAddress,
            "personal_phone_number" => $personalPhoneNumber,
            "company_email_address" => $companyEmailAddress,
            "company_phone_number" => $companyPhoneNumber,
            "picture" => $picture,
            "city" => $city,
            "country" => $country,
            "marital_status" => $maritalStatus,
            "hire_date" => $hireDate,
            "probation_period_start" => $probationStartDate,
            "probation_period_end" => $probationEndDate,
            "designation_id" => $designationId,
            "leave_policy_id" => $leavePolicyId,
            "employee_type" => $employeeType,
            "contract_start_date" => $contractStartDate,
            "contract_end_date" => $contractEndDate,
            "user_id" => $userId
        ]);

        $employee->save();
        return $employee;
    }

    /**
     * @param $id
     * @param $firstName
     * @param $lastName
     * @param $personalEmailAddress
     * @param $personalPhoneNumber
     * @param $companyEmailAddress
     * @param $companyPhoneNumber
     * @param $picture
     * @param $city
     * @param $country
     * @param $maritalStatus
     * @param $hireDate
     * @param $probationStartDate
     * @param $probationEndDate
     * @param $designationId
     * @param $leavePolicyId
     * @return mixed
     */
    public function updateEmployee($id, $firstName, $lastName, $personalEmailAddress, $personalPhoneNumber
        ,                          $companyEmailAddress, $companyPhoneNumber, $picture, $city, $country,
                                   $maritalStatus, $hireDate, $probationStartDate, $probationEndDate,
                                   $designationId, $leavePolicyId, $employeeType, $contractStartDate, $contractEndDate, $userId)
    {
        $employee = Employees::find($id);
        $employee->first_name = $firstName;
        $employee->last_name = $lastName;
        $employee->personal_email_address = $personalEmailAddress;
        $employee->personal_phone_number = $personalPhoneNumber;
        $employee->company_email_address = $companyEmailAddress;
        $employee->company_phone_number = $companyPhoneNumber;
        if($picture != null){
            $employee->picture = $picture;
        }
        $employee->city = $city;
        $employee->country = $country;
        $employee->marital_status = $maritalStatus;
        $employee->hire_date = $hireDate;
        $employee->probation_period_start = $probationStartDate;
        $employee->probation_period_end = $probationEndDate;
        $employee->designation_id = $designationId;
        $employee->leave_policy_id = $leavePolicyId;
        $employee->employee_type = $employeeType;
        $employee->contract_start_date = $contractStartDate;
        $employee->contract_end_date = $contractEndDate;
        $employee->user_id = $userId;


        return $employee->save();
    }

    public function updateEmployeePersonalInformation($id, $firstName = null, $lastName = null, $personalEmailAddress = null, $personalPhoneNumber = null
        ,                                             $companyEmailAddress = null, $companyPhoneNumber = null, $picture = null, $city = null, $country = null,
                                                      $maritalStatus = null, $hireDate = null, $probationStartDate = null, $probationEndDate = null)
    {
        $personal_information = Employees::find($id);


        $personal_information->first_name = $firstName;
        $personal_information->last_name = $lastName;
        $personal_information->personal_email_address = $personalEmailAddress;
        $personal_information->personal_phone_number = $personalPhoneNumber;
        $personal_information->company_email_address = $companyEmailAddress;
        $personal_information->company_phone_number = $companyPhoneNumber;
        $personal_information->picture = $picture;
        $personal_information->city = $city;
        $personal_information->country = $country;
        $personal_information->marital_status = $maritalStatus;
        $personal_information->hire_date = $hireDate;
        $personal_information->probation_period_start = $probationStartDate;
        $personal_information->probation_period_end = $probationEndDate;


        return $personal_information->save();
    }

    public function updateEmployment($id, $designationId, $employType, $contractStart, $contractEnd)
    {
        $employment = Employees::find($id);
        $employment->designation_id = $designationId;
        $employment->employee_type = $employType;
        $employment->contract_start_date = $contractStart;
        $employment->contract_end_date = $contractEnd;
        return $employment->save();

    }

    public function updateEmployeeBank($id, $bankName, $accountTitle, $accountNumber, $iban, $swiftCode, $sortCode, $accountCurrency)
    {
        $bank = Banks::where(['employee_id'=>$id])->firstOrFail();
        $bank->bank_name = $bankName;
        $bank->account_title = $accountTitle;
        $bank->account_number = $accountNumber;
        $bank->iban = $iban;
        $bank->swift_code = $swiftCode;
        $bank->sort_code = $sortCode;
        $bank->account_currency = $accountCurrency;

        return $bank->save();

    }

    public function updateLeavePolicy($id,$leavePolicy)
    {
        $employee = Employees::find($id);
        $employee->leave_policy_id = $leavePolicy;
        return $employee->save();
    }

    public function updateSalary($id,$basicSalary,$salaryCycle,$taxable,$taxClass)
    {
        $salary = EmployeeSalary::where(['employee_id'=>$id])->firstOrFail();
        $salary->basic_salary = $basicSalary;
        $salary->cycle = $salaryCycle;
        $salary->taxable = $taxable;
        $salary->tax_id = $taxClass;

        return $salary->save();
    }


    /**
     * @return mixed
     */
    public function getEmployees()
    {
        return Employees::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEmployee($id)
    {
        return Employees::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteEmployee($id)
    {
        return Employees::where(["id" => $id])->delete();
    }
}
