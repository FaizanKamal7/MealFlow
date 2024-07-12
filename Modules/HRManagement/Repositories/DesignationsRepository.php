<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\Designations;
use Modules\HRManagement\Interfaces\DesignationInterface;

class DesignationsRepository implements DesignationInterface
{

    /**
     * @param $name
     * @param $parentDesignationId
     * @return mixed
     */
    public function createDesignation($name, $parentDesignationId = null)
    {
        $designation = new Designations([
            "name" => $name,
            "parent_designation_id" => $parentDesignationId,
        ]);

        return $designation->save();
    }

    /**
     * @param $id
     * @param $name
     * @param $parentDesignationId
     * @return mixed
     */
    public function updateDesignation($id, $name = null, $parentDesignationId = null)
    {
        $designation = Designations::find($id);
        if ($name != null) {
            $designation->name = $name;
        }
        if ($parentDesignationId) {
            $designation->parent_designation_id = $parentDesignationId;
        }
        $designation->save();
    }

    /**
     * @return mixed
     */
    public function getDesignations()
    {
        return Designations::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDesignation($id)
    {
        return Designations::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteDesignation($id)
    {
        return Designations::where(["id" => $id])->delete();

    }
}
