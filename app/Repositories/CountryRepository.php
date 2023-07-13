<?php

namespace App\Repositories;

use App\Interfaces\CountryInterface;
use App\Models\Country;

class CountryRepository implements CountryInterface
{

    public function update($id, $data)
    {
        return Country::where('id', $id)->update($data);
    }

    public function getAllCountries()
    {
        return Country::all();
    }

    public function getAllActiveCountries()
    {
        return Country::where(["active_status" => 1])->get();
    }

    public function getAllCountryStateCities()
    {
        // return Country::select('cities.name as city', 'states.name as state', 'countries.name as country')
        //     ->leftJoin('states', 'states.country_id', '=', 'countries.id')
        //     ->leftJoin('cities', 'cities.state_id', '=', 'states.id')
        //     ->get();
        // return Country::select('cities.name as city', 'states.name as state', 'countries.name as country')
        // ->leftJoin('states', 'states.country_id', '=', 'countries.id')
        // ->leftJoin('cities', 'cities.state_id', '=', 'states.id')
        // ->get();

        return Country::select('countries')
            ->crossJoin('states')
            ->crossJoin('cities')
            ->select('countries.name', 'states.name', 'cities.name')
            ->get();

        // return Country::all();
    }
}
