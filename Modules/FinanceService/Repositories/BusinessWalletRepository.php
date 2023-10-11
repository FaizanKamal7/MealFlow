<?php

namespace Modules\FinanceService\Repositories;

use Illuminate\Support\Facades\DB;
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

    public function update($business_id, $data)
    {
        return BusinessWallet::find($business_id)->update($data);
    }

    public function debitWallet($business_id, $amount_to_deduct)
    {
        $db_wallet = BusinessWallet::where('business_id', $business_id)->first();
        $new_balance = $db_wallet->balance - $amount_to_deduct;
        BusinessWallet::find($db_wallet->id)->update(['balance' => $new_balance]);
        // BusinessWallet::where('business_id', $business_id)->update(['balance' => \DB::raw("balance - $amount_to_deduct")]); // Not firing even listner
    }
}
