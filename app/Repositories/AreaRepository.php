<?php

namespace App\Repositories;

use App\Interfaces\AreaInterface;
use App\Models\Area;

class AreaRepository implements AreaInterface
{
    public function add($data)
    {
        return Area::create($data);
    }

    public function getAllAreas()
    {
        return Area::all();
    }

    public function getWhere($where)
    {
        return Area::with('city')->where($where)->get();
    }

    public function getWhereSingle($where)
    {
        return Area::where($where)->first();
    }

    public function getAreasOfCity($city_id)
    {
        return Area::where(["city_id" => $city_id, "active_status" => 1])->get();
    }
}