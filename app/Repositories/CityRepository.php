<?php

namespace App\Repositories;

use App\Interfaces\CityInterface;
use App\Models\City;
use Yajra\DataTables\DataTables;

class CityRepository implements CityInterface
{

    public function get($id)
    {
        return City::find($id);
    }

    public function update($id, $data)
    {
        return City::where('id', $id)->update($data);
    }

    public function getAllCities()
    {
        // return City::paginate(50);
        return City::whereIn('state_id', ['3390', '3391', '3392', '3393', '3394', '3395', '3396'])->get();

        // $cities = City::get('id', 'active', 'name', 'state_id', 'country_id');
        // return DataTables::of($cities)->make(true);
    }

    public function getCitiesOfState($state_id)
    {
        return City::where(["state_id" => $state_id, "active_status" => 1])->get();
    }

    public function searchCity($searchTerm)
    {
        return City::where('name', 'like', "%{$searchTerm}%")->get();
    }
}
