<?php

namespace App\Repositories;

use App\Interfaces\CityInterface;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use Modules\BusinessService\Entities\Business;
use Yajra\DataTables\DataTables;

class CityRepository implements CityInterface
{

    public function get($id)
    {
        return City::find($id);
    }

    public function getWhere($where)
    {
        return City::where($where)->get();
    }

    public function update($id, $data)
    {
        return City::where('id', $id)->update($data);
    }

    public function getAllCities()
    {
        return City::paginate(10);
        // return City::all();
        // return City::whereIn('state_id', ['3390', '3391', '3392', '3393', '3394', '3395', '3396'])->get();

        // $cities = City::get('id', 'active', 'name', 'state_id', 'country_id');
        // return DataTables::of($cities)->make(true);
    }
    public function getActiveCities()
    {
        return City::where(["active_status" => "1"])->get();
    }

    //method to get cities matching the keyword of city name from location table
    public function getSearchCities($query)
    {
        $searchResults = City::where('name', 'like', '%' . $query . '%')->paginate(10);
        // $cities = City::where('name', 'like', '%' . $query . '%')->paginate(10);

        // $searchResults = City::where('name', 'like', '%' . $query . '%')->get();
        return $searchResults;
    }

    public function getCitiesOfState($state_id)
    {
        return City::where(["state_id" => $state_id, "active_status" => 1])->get();
    }

    public function searchCity($searchTerm)
    {
        return City::where('name', 'like', "%{$searchTerm}%")->get();
    }


    public function searchCityFirst($searchTerm)
    {
        return City::where('name', 'like', "%{$searchTerm}%")->first();
    }

    // =============================================================================================
    // ===============================  A P I   F U N C T I O N S   ================================
    // =============================================================================================


    public function getFormattedActiveCities()
    {
        // return City::where(["active_status" => "1"])->get();
        return  City::select(
            'cities.id as city_id',
            DB::raw('CONCAT(cities.name, " (", states.name, ", ", countries.name, ")") AS city')
        )
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->where('cities.active_status', true)
            ->orderBy('cities.active_status', 'desc') // Order by active_status to get true values first
            ->get();
    }
}
