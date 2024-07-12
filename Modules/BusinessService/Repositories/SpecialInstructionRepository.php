<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\SpecialInstruction;
use Modules\BusinessService\Interfaces\SpecialInstructionInterface;

class SpecialInstructionRepository implements SpecialInstructionInterface

{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function get()
    {
        return SpecialInstruction::all();
    }

    public function create($data)
    {
        return SpecialInstruction::create($data);
    }
}
