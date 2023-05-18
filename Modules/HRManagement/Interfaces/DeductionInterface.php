<?php

namespace Modules\HRManagement\Interfaces;

interface DeductionInterface
{
  public function createDeduction($amount,$employeeId,$description=null,$code=null,$date=null,$deducted=false,$status="Pending");
  public function updateDeduction($id,$amount=null,$employeeId=null,$description=null,$code=null,$date=null,$deducted=false,$status=null);
  public function getDeductions();
  public function getDeduction($id);
  public function deleteDeduction($id);
  public function getDeductionsByEmployee($employeeId);
  public function getDeductionsByCustomFilter($amount=null,$employeeId=null,$date=null,$deducted=false,$status=null,$fromDate=null,$toDate=null);

  public function approveDeduction($id);
  public function rejectDeduction($id);
  public function deductDeduction($id);
}
