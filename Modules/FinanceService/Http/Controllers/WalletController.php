<?php

namespace Modules\FinanceService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\FinanceService\Interfaces\BusinessWalletInterface;

class WalletController extends Controller
{
    private BusinessWalletInterface $businessWalletRepository;

    public function __construct(BusinessWalletInterface $businessWalletRepository){
        $this->businessWalletRepository = $businessWalletRepository;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function viewWallet()
    {
        return view('businessservice::business_info.wallet.Wallet');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('financeservice::create');
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
        return view('financeservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('financeservice::edit');
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
