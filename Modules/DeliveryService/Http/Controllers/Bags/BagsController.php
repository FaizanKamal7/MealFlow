<?php

namespace Modules\DeliveryService\Http\Controllers\Bags;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\DeliveryService\Interfaces\BagsInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BagsController extends Controller
{

    private BagsInterface $bagsRepository;

    /**
     * @param BagsInterface $bagsRepository
     */
    public function __construct(BagsInterface $bagsRepository)
    {
        $this->bagsRepository = $bagsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function viewAllBags()
    {
        return view('deliveryservice::index');
    }
    public function addBag()
    {
        
        return view('deliveryservice::bags.add_bag');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeBag(Request $request,$partner_id)
    {
        $path = public_path('media/bags/qrcodes/' . time() . '.svg');

        $request->validate([
            'partner_id'=>['required'],
            'no_of_bags'=>['required','numeric']
        ]);
        echo "here".$partner_id;
        // try {
        //     $bag = $this->bagsRepository->addNewBag(qrCode: "", bagNumber: $request->get("bag_number"), bagSize: $request->get("bag_size"), bagType: $request->get("bag_size"), weight: $request->get("weight"), dimensions: $request->get("dimensions"));
        //     QrCode::size(400)
        //         ->generate($bag->id, $path);
        //     $this->bagsRepository->updateBag(id: $bag->id, qrCode: $path, bagNumber: "", bagSize: "", bagType: "", status: "", weight: "", dimensions: "");
        // } catch (Exception $exception) {
        //     Log::error($exception);
        //     return redirect()->to("del_bags")->with("error", "Something went wrong!Contact support");
        // }
    }

    /**
     * Show the specified resource.
     * @param int $id
     */
    public function showBag($id)
    {
        return view('deliveryservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editBag($id)
    {
        return view('deliveryservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function updateBag(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyBag($id)
    {
        //
    }
}
