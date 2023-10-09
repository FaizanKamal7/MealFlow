<?php

namespace Modules\FinanceService\Repositories;

use Modules\FinanceService\Entities\BusinessWallet;
use Modules\FinanceService\Interfaces\BusinessWalletInterface;

/**
 * Summary of BusinessWalletRepository
 */
class BusinessWalletRepository implements BusinessWalletInterface
{

    public function createWallet($business_id)
    {
        return BusinessWallet::create([
            "business_id" => $business_id,
            "balance" => 0,
        ]);
    }

    public function getWallet($id)
    {
        return BusinessWallet::find($id);
    }

    public function getBusinessWallet($business_id)
    {
        return BusinessWallet::where('business_id', $business_id)->first();
    }

    public function updateWallet($id, $balance)
    {
        return BusinessWallet::find($id)->update([
            "balance" => $balance
        ]);
    }
}
