<?php

namespace Modules\BusinessService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BusinessOnboardingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('businessservice::index');
    }

    public function edit($id)
    {
        return view('businessservice::edit');
    }

  
}