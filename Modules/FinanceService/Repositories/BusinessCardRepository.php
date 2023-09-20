<?php
namespace Modules\FinanceService\Repositories;

use Modules\FinanceService\Entities\BusinessCard;
use Modules\FinanceService\Interfaces\BusinessCardInterface;

class BusinessCardRepository implements BusinessCardInterface
{

    public function createBusinessCard($card_number, $card_holder_name, $brand, $exp_month, $exp_year, $wallet_id)
    {
        $existing_card = BusinessCard::where([
            'card_number' => $card_number,
            'card_holder_name' => $card_holder_name,
            'brand' => $brand,
            'exp_month' => $exp_month,
            'exp_year' => $exp_year,
            'wallet_id' => $wallet_id,
        ])->first();

        if (!$existing_card) {
            return BusinessCard::create([
                'card_number' => $card_number,
                'card_holder_name' => $card_holder_name,
                'brand' => $brand,
                'exp_month' => $exp_month,
                'exp_year' => $exp_year,
                'wallet_id' => $wallet_id,
            ]);
        }
        return $existing_card;

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