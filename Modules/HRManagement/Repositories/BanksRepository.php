<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\Banks;
use Modules\HRManagement\Interfaces\BanksInterface;

class BanksRepository implements BanksInterface
{

    /**
     * @param $bankName
     * @param $employeeId
     * @param $iban
     * @param $accountTitle
     * @param $accountNumber
     * @param $swiftCode
     * @param $sortCode
     * @param $accountCurrency
     * @return mixed
     */
    public function createBank($bankName, $employeeId, $iban = null, $accountTitle = null, $accountNumber = null, $swiftCode = null, $sortCode = null, $accountCurrency = null)
    {
        $bank =  new Banks([
            "bank_name"=>$bankName,
            "iban"=>$iban,
            "account_title"=>$accountTitle,
            "account_number"=>$accountNumber,
            "swift_code"=>$swiftCode,
            "sort_code"=>$sortCode,
            "account_currency"=>$accountCurrency,
            "status"=>"active",
            "employee_id"=>$employeeId,
        ]);
        return $bank->save();
    }

    /**
     * @param $id
     * @param $bankName
     * @param $employeeId
     * @param $iban
     * @param $accountTitle
     * @param $accountNumber
     * @param $swiftCode
     * @param $sortCode
     * @param $accountCurrency
     * @return mixed
     */
    public function updateBank($id, $bankName = null, $employeeId = null, $iban = null, $accountTitle = null, $accountNumber = null, $swiftCode = null, $sortCode = null, $accountCurrency = null)
    {
        $bank = Banks::find($id);
        if ($bankName){
            $bank->bank_name = $bankName;
        }
        if ($employeeId){
            $bank->employee_id = $employeeId;
        }
        if ($iban){
            $bank->iban = $iban;
        }
        if ($accountTitle){
            $bank->account_title = $accountTitle;
        }
        if ($accountNumber){
            $bank->account_number = $accountNumber;
        }
        if ($swiftCode){
            $bank->swift_code = $swiftCode;
        }
        if ($sortCode){
            $bank->sort_code = $sortCode;
        }
        if ($accountCurrency){
            $bank->account_currency = $accountCurrency;
        }
    }

    /**
     * @return mixed
     */
    public function getBanks()
    {
        return Banks::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getBank($id)
    {
        return Banks::find($id);
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getEmployeeBank($employeeId)
    {
        return Banks::where(["employee_id"=>$employeeId])->first();

    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteBank($id)
    {
        return Banks::where(["id"=>$id])->delete();
    }
}
