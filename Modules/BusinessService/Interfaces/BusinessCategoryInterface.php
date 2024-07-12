<?php

namespace Modules\BusinessService\Interfaces;

interface BusinessCategoryInterface
{
    public function createBusinessCategory($name, $status);

    public function getBusinessCategory();

}