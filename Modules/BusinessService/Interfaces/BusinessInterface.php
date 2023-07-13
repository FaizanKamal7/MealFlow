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
    );

    public function getNewBusinesses();
}