<?php

namespace App\Http\Controllers\Admin\LocationManagement;

use App\Http\Controllers\Controller;
use App\Interfaces\CityInterface;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private CityInterface $cityRepository;


    public function __construct(CityInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        $cities = $this->cityRepository->getAllCities();
        return view('admin.locations.activate_location', ['cities' => $cities]);
    }
}
