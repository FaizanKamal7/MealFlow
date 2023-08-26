<?php

namespace Modules\FinanceService\Interfaces;

interface WalletCreditInterface{
    public function createWalletCredit($amount,$transection_date,$payment_method,$wallet_id,$card_id);
    public function getWalletCredit($id);
    public function deleteWalletCredit($id);

}