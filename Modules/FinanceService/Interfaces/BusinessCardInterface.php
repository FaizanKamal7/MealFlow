<?php

namespace Modules\FinanceService\Interfaces;

interface BusinessCardInterface {

    public function createBusinessCard($card_number,$card_holder_name,$brand,$exp_month,$exp_year,$wallet_id);
    public function getBusinessCard($id);
    public function destroyBusinessCard($id);

}