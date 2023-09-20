<?php

namespace App\Http\Controllers\Admin\LocationManagement\City;

use App\Http\Controllers\Controller;
use App\Interfaces\CityInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{

    private CityInterface $cityRepository;

    public function __construct(CityInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function getCitiesOfState(Request $request)
    {
        $cities = [];
        if ($request) {
            $cities = $this->cityRepository->getCitiesOfState($request->state_id);
        }
        return response()->json($cities->toArray());
    }

    public function search(Request $request)
    {
        $searchTerm = $request->get('search');
        $cities = $this->cityRepository->searchCity($searchTerm);
        return response()->json($cities);
    }

    public function index()
    {
        //
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
        //
    }
}
