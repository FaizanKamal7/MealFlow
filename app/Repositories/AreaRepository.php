<?php

namespace App\Repositories;

use App\Interfaces\AreaInterface;
use App\Models\Area;
use Illuminate\Support\Facades\DB;
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

    public function createArea($name, $city_id, $coordinates = null, $geoname_id = null)
    {
        return Area::create([
            'active_status' => true,
            'name' => $name,
            'city_id' => $city_id,
            'coordinates' => $coordinates,
            'geoname_id' => $geoname_id
        ]);
    }

    // =============================================================================================
    // ===============================  A P I   F U N C T I O N S   ================================
    // =============================================================================================


    public function getFormattedAreas()
    {
        // return City::where(["active_status" => "1"])->get();
        return  Area::select(
            'areas.id as area_id',
            DB::raw('CONCAT(areas.name, " (", cities.name, ", ", states.name, ", ", countries.name, ")") AS city')
        )
            ->join('cities', 'areas.city_id', '=', 'cities.id')
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->where('areas.active_status', true)
            ->orderBy('areas.active_status', 'desc') // Order by active_status to get true values first
            ->get();
    }
}
