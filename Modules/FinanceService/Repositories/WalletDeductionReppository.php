<?php

namespace Modules\FinanceService\Repositories;

use Modules\FinanceService\Entities\WalletDeduction;
use Modules\FinanceService\Interfaces\WalletDeductionInterface;

class WalletDeductionRepository implements WalletDeductionInterface
{
    public function createWalletDeduction($transection_date, $wallet_id, $invoice_item_id)
    {
        return WalletDeduction::create([
            'transaction_date' => $transection_date,
            'wallet_id' => $wallet_id,
            'invoice_item_id' => $invoice_item_id,
        ]);
    }
    public function getWalletDeduction($id)
    {
        return WalletDeduction::find($id);
    }
    public function deleteWalletDeductioon($id)
    {
        return WalletDeduction::find($id)->delete();
    }
}
