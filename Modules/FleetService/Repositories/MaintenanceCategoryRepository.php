<?php

namespace Modules\FleetService\Repositories;
use Modules\FleetService\Interfaces\MaintenanceCategoryInterface;
use Modules\FleetService\Entities\MaintenanceCategory;



class MaintenanceCategoryRepository implements MaintenanceCategoryInterface
{
    public function getMaintenanceCategories(){
        return MaintenanceCategory::all();
    }
}
