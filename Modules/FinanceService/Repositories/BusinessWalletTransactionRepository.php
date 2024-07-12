<?php

namespace Modules\FinanceService\Repositories;

use App\Enum\BusinessWalletTransactionStatusEnum;
use Illuminate\Support\Facades\DB;
use Modules\FinanceService\Entities\BusinessWalletTransaction;
use Modules\FinanceService\Interfaces\BusinessWalletTransactionInterface;

/**
 * Summary of BusinessWalletRepository
 */
class BusinessWalletTransactionRepository implements BusinessWalletTransactionInterface
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
        $note = null
    ) {

        return BusinessWalletTransaction::create([
            'amount' => $amount,
            'type' => $type,
            'wallet_id' => $wallet_id,
            'status' => $status,
            'info' => $info,
            'payment_method_id' => $payment_method_id,
            'invoice_item_id' => $invoice_item_id,
            'card_id' => $card_id,
            'note' => $note,
            'transaction_date' => date("Y-m-d H:i:s"),
        ]);
    }


    public function getPendingBusinessWalletTransaction()
    {
        return BusinessWalletTransaction::with(['businessWallet.business'])->where("status", BusinessWalletTransactionStatusEnum::PENDING->value)->get();
        // $transactions = BusinessWalletTransaction::where("status", BusinessWalletTransactionStatusEnum::PENDING->value)
        //     ->with(['businessWallet.business' => function ($query) use ($businessName) {
        //         $query->where('name', $businessName);
        //     }])
        //     ->get();
    }

    public function updateBusinessWalletTransactionWhere($id, $data)
    {
        return BusinessWalletTransaction::find($id)->update($data);
    }
}
