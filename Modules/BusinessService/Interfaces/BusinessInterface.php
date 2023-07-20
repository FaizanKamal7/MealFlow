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
    );

    public function getNewBusinesses();
<<<<<<< HEAD
    public function getBusinesses();
=======
>>>>>>> c32ed94c7b3477100353508d492d5dbcc80033b7
}
