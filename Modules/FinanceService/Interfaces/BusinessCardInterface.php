<?php

namespace Modules\FinanceService\Interfaces;

interface BusinessCardInterface {

    public function createBusinessCard($card_holder_name,$cvv,$exp_month,$exp_year,$wallet_id);
    public function getBusinessCard($id);
    public function destroyBusinessCard($id);

}