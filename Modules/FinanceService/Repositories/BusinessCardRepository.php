<?php
namespace Modules\FinanceService\Repositories;

use Modules\FinanceService\Entities\BusinessCard;
use Modules\FinanceService\Interfaces\BusinessCardInterface;

class BusinessCardRepository implements BusinessCardInterface
{

    public function createBusinessCard($card_holder_name,$cvv,$expiry_month,$expiry_year,$wallet_id)
    {
        return BusinessCard::create([
            'card_holder_name'=> $card_holder_name,
            'cvv'=> $cvv,
            'expiry_month'=>$expiry_month ,
            'expiry_year'=> $expiry_year,
            'wallet_id'=> $wallet_id,
        ]);
    }
    public function getBusinessCard($id)
    {
        return BusinessCard::find($id);

    }
    public function destroyBusinessCard($id)
    {
        return BusinessCard::find($id)->delete();
    }
}