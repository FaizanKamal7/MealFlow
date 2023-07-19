<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\CountryInterface;
use App\Interfaces\StateInterface;
use Illuminate\Http\Request;
use Modules\BusinessService\Entities\Business;

class SettingsController extends Controller
{
    private CountryInterface $countryRepository;
    private StateInterface $stateRepository;
    private CityInterface $cityRepository;
    private AreaInterface $areaRepository;

    public function __construct(
        CountryInterface $countryRepository,
        StateInterface $stateRepository,
        CityInterface $cityRepository,
        AreaInterface $areaRepository,
    ) {
        $this->countryRepository = $countryRepository;
        $this->stateRepository = $stateRepository;
        $this->cityRepository = $cityRepository;
        $this->areaRepository = $areaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $countries  = $this->countryRepository->getAllCountries();
        // return view("admin.settings.settings", ['countries' => $countries]);
        // $countries  = $this->countryRepository->getAllCountryStateCities();
        $cities  = $this->cityRepository->getAllCities();
        // dd($cities);
        // echo  $countries;
        return view("admin.settings.settings", ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     

    }
}