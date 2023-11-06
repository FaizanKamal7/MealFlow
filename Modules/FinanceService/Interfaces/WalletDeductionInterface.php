<?php

namespace Modules\FinanceService\Interfaces;

interface WalletDeductionInterface
{
    public function createWalletDeduction($transection_date, $wallet_id, $invoice_item_id);
    public function getWalletDeduction($id);
    public function deleteWalletDeductioon($id);
}
