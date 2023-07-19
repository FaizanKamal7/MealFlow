<?php

namespace App\Repositories;

use App\Interfaces\CityInterface;
use App\Models\City;

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
        return City::paginate(50);
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
