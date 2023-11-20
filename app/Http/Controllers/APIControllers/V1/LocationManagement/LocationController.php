<?php

namespace App\Http\Controllers\Admin\LocationManagement;

use App\Http\Controllers\Controller;
use App\Interfaces\CityInterface;
use App\Interfaces\CountryInterface;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private CityInterface $cityRepository;
    private CountryInterface $countryRepository;



    public function __construct(CityInterface $cityRepository, CountryInterface $countryRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->countryRepository = $countryRepository;
    }

    public function index()
    {
        $cities = $this->cityRepository->getAllCities();
        return view('admin.locations.activate_location', ['cities' => $cities]);
    }

    public function table_data(Request $request)
    {
        $cities = $this->cityRepository->getAllCities();
        return view('includes.location_table', ['cities' => $cities])->render();
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $cities = $this->cityRepository->getSearchCities($query);
        return view('admin.locations.activate_location', compact('cities'));
    }



    public function activatedLocations()
    {
        $countries = $this->countryRepository->getCountryWithItsLocations();
        return view('admin.locations.activated_locations', ['countries' => $countries]);
    }
}