<?php

namespace Modules\HRManagement\Interfaces;

interface BanksInterface
{
  public function createBank($bankName,$employeeId,$iban=null,$accountTitle=null,$accountNumber=null,$swiftCode=null,$sortCode=null,$accountCurrency=null);
  public function updateBank($id,$bankName=null,$employeeId=null,$iban=null,$accountTitle=null,$accountNumber=null,$swiftCode=null,$sortCode=null,$accountCurrency=null);
  public function getBanks();
  public function getBank($id);
  public function getEmployeeBank($employeeId);
  public function deleteBank($id);
}
