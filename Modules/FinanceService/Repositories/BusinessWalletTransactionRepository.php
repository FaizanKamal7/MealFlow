<?php

namespace Modules\FinanceService\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\FinanceService\Entities\BusinessWalletTransaction;
use Modules\FinanceService\Interfaces\BusinessWalletTransactionInterface;

/**
 * Summary of BusinessWalletRepository
 */
class BusinessWalletTransactionRepository implements BusinessWalletTransactionInterface
{
    public function createBusinessWalletTransactions($amount, $type, $wallet_id, $invoice_item_id  = null, $payment_method_id = null, $card_id = null, $note = null)
    {
        return BusinessWalletTransaction::create([
            'amount' => $amount,
            'type' => $type,
            'wallet_id' => $wallet_id,
            'note' => $note,
            'payment_method_id' => $payment_method_id,
            'invoice_item_id' => $invoice_item_id,
            'card_id' => $card_id,
            'transaction_date' => date("Y-m-d H:i:s"),

        ]);
    }
}
