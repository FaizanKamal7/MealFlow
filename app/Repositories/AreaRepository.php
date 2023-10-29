<?php

namespace App\Repositories;

use App\Interfaces\AreaInterface;
use App\Models\Area;
use Illuminate\Support\Str;


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
    public function getAreaById($id)
    {
        // return Area::where($id)->get();
        return Area::find($id);
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

    public function updateOrInsertAreaIfAttributeExist($attribute, $value, $data)
    {
        $uuid = Str::uuid()->toString();
        $data['id'] = $uuid;

        return Area::updateOrInsert(
            [$attribute => $value],
            $data
        );
    }
    public function searchArea($searchTerm)
    {
        return Area::where('name', 'like', "%{$searchTerm}%")->get();
    }

    public function searchAreaFirst($searchTerm)
    {
        return Area::where('name', 'like', "%{$searchTerm}%")->first();
    }
}
