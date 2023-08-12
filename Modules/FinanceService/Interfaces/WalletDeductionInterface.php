<?php

namespace Modules\FinanceService\Interfaces;

interface WalletDeductionInterface{
    public function createWalletDeduction();
    public function getWalletDeduction($id);
    public function deleteWalletDeductioon($id);
}