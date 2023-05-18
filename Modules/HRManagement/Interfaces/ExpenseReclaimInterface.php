<?php

namespace Modules\HRManagement\Interfaces;

interface ExpenseReclaimInterface
{
    public function createExpenseReclaim($title, $currency, $exchangeRate, $amount, $purchaseDate, $category = null, $invoice = null, $purchasedFrom = null, $entryDate = null, $status = "pending", $resolutionDate = null, $notes = null, $employeeId = null);

    public function updateExpenseReclaim($id, $title = null, $currency = null, $exchangeRate = null, $amount = null, $purchaseDate = null, $category = null, $invoice = null, $purchasedFrom = null, $entryDate = null, $status = "pending", $resolutionDate = null, $notes = null, $employeeId = null);

    public function getExpenseReclaims();

    public function getExpenseReclaim($id);

    public function deleteExpenseReclaim($id);

    public function getExpenseReclaimByEmployee($employeeId);

}
