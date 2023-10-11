<?php

namespace Modules\FinanceService\Interfaces;

interface BusinessWalletTransactionInterface
{
    public function createBusinessWalletTransactions($amount, $type, $wallet_id, $invoice_item_id  = null, $payment_method_id = null, $card_id = null, $note = null);
}
