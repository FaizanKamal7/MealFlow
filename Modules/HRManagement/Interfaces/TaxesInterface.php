<?php

namespace Modules\HRManagement\Interfaces;

interface TaxesInterface
{
public function createTax($name,$amountPercentage);
public function updateTax($id,$name=null,$amountPercentage=null);
public function getTaxes();
public function getTax($id);
public function deleteTax($id);
}
