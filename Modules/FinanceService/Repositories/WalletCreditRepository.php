<?php
namespace Modules\FinanceService\Repositories;

use Modules\FinanceService\Entities\WalletCredit;
use Modules\FinanceService\Interfaces\WalletCreditInterface;

class WalletCreditRepository implements WalletCreditInterface
{
    public function createWalletCredit($amount,$transection_date,$payment_method,$wallet_id,$card_id)
    {
        return WalletCredit::create([
            'amount'=> $amount,
            'transaction_date'=> $transection_date,
            'payment_method'=> $payment_method,
            'wallet_id'=> $wallet_id,
            'card_id'=> $card_id,
        ]);
    }
    public function getWalletCredit($id)
    {
        return WalletCredit::find($id);

    }
    public function deleteWalletCredit($id)
    {
        return WalletCredit::find($id)->delete();
    }
}