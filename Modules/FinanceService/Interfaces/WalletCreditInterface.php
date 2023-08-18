<?php

namespace Modules\FinanceService\Interfaces;

interface WalletCreditInterface{
    public function createWalletCredit();
    public function getWalletCredit($id);
    public function deleteWalletCredit($id);

}