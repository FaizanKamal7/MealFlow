<?php

namespace Modules\FinanceService\Interfaces;

interface BusinessCardInterface {

    public function createBusinessCard($card_holder_name,$cvv,$expiry_month,$expiry_year,$wallet_id);
    public function getBusinessCard($id);
    public function destroyBusinessCard($id);

}