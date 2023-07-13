<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\BusinessCategory;
use Modules\BusinessService\Interfaces\BusinessCategoryInterface;

class BusinessCategoryRepository implements BusinessCategoryInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function createBusinessCategory($name, $status = "active")
    {
        $businessCategory = new BusinessCategory([
            "name" => $name,
            "status" => $status,
        ]);
        $businessCategory->save();
        return $businessCategory;
    }

    public function getBusinessCategory()
    {
        return BusinessCategory::all();
    }
}
