<?php

namespace App\Observers;

use App\Models\BusinessWallet;

class BusinessWalletObserver
{
    /**
     * Handle the BusinessWallet "created" event.
     *
     * @param  \App\Models\BusinessWallet  $businessWallet
     * @return void
     */
    public function created(BusinessWallet $businessWallet)
    {
        //
    }

    /**
     * Handle the BusinessWallet "updated" event.
     *
     * @param  \App\Models\BusinessWallet  $businessWallet
     * @return void
     */
    public function updated(BusinessWallet $businessWallet)
    {
        //
    }

    /**
     * Handle the BusinessWallet "deleted" event.
     *
     * @param  \App\Models\BusinessWallet  $businessWallet
     * @return void
     */
    public function deleted(BusinessWallet $businessWallet)
    {
        //
    }

    /**
     * Handle the BusinessWallet "restored" event.
     *
     * @param  \App\Models\BusinessWallet  $businessWallet
     * @return void
     */
    public function restored(BusinessWallet $businessWallet)
    {
        //
    }

    /**
     * Handle the BusinessWallet "force deleted" event.
     *
     * @param  \App\Models\BusinessWallet  $businessWallet
     * @return void
     */
    public function forceDeleted(BusinessWallet $businessWallet)
    {
        //
    }
}
