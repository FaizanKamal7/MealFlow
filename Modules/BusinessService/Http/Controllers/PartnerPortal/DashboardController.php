<?php

namespace Modules\BusinessService\Http\Controllers\PartnerPortal;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.

     */
    public function dashboard()
    {
        return view('businessservice::partner_portal.dashboard');
    }

    /**
     * Show the form for creating a new resource.

     */
    public function create()
    {
        return view('businessservice::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request

     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id

     */
    public function show($id)
    {
        return view('businessservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id

     */
    public function edit($id)
    {
        return view('businessservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id

     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id

     */
    public function destroy($id)
    {
        //
    }
}
