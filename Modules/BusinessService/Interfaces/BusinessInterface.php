<?php

namespace Modules\BusinessService\Interfaces;

interface BusinessInterface
{
    public function createBusiness(
        $name,
        $logo,
        $card_name,
        $card_number,
        $card_expiry_month,
        $card_expiry_year,
        $card_cvv,
        $business_category_id,
        $admin,
        $status,
        $trade_licence_file,
        $state_legal_id,
        $trn_number,
        $trn_file
    );

    public function getNewBusinesses();
    public function get();
    public function getActiveBusinesses();
    public function getBusiness($id);
}
