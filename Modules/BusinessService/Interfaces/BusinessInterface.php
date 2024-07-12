<?php

namespace Modules\BusinessService\Interfaces;

interface BusinessInterface
{
    public function createBusiness(
        $name,
        $business_category_id,
        $admin,
        $status,
        $trade_licence_file = null,
        $state_legal_id = null,
        $trn_number = null,
        $trn_file = null,
        $logo = null
    );

    public function getNewBusinesses();
    public function get();
    public function getActiveBusinesses();
    public function getBusiness($id);
    public function getSingleBusinessWhere($where);
    public function getFormattedBusinessInfo($business_id);
}
