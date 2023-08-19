<?php

namespace Modules\FinanceService\Interfaces;

interface BusinessWalletInterface {
    
    public function createWallet($balance);
    public function getWallet($id);
    public function updateWallet($id,$balance);
}