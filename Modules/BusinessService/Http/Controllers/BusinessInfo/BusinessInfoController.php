<?php

namespace Modules\BusinessService\Http\Controllers\BusinessInfo;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BusinessService\Interfaces\BusinessInterface;

class BusinessInfoController extends Controller
{
    private BusinessInterface $businessRepository;

    public function __construct(BusinessInterface $businessRepository)
    {
        $this->businessRepository = $businessRepository;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($business_id)
    {
        $business = $this->businessRepository->getBusiness($business_id);
        $business_cities = $this->businessRepository->getBusiness($business_id);
        
        return view('businessservice::business_info.business_overview', ['business' => $business]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('businessservice::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('businessservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('businessservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
