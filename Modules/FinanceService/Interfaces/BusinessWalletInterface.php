<?php

namespace Modules\FinanceService\Interfaces;

interface BusinessWalletInterface
{

    public function createWallet($balance);
    public function getWallet($id);
    public function debitWallet($business_id, $amount_to_deduct);
    public function getBusinessWallet($id);
    public function update($business_id, $data);
    public function creditWallet($business_id, $amount_to_add);
}
