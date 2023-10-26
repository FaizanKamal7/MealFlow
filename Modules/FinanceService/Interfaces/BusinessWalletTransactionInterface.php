<?php

namespace Modules\FinanceService\Interfaces;

interface BusinessWalletTransactionInterface
{
    public function createBusinessWalletTransactions(
        $amount,
        $type,
        $wallet_id,
        $status,
        $info = null,
        $invoice_item_id  = null,
        $payment_method_id = null,
        $card_id = null,
        $note = null,
    );
    public function getPendingBusinessWalletTransaction();
    public function updateBusinessWalletTransactionWhere($id, $data);
}
