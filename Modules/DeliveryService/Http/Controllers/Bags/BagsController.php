<?php

namespace Modules\DeliveryService\Http\Controllers\Bags;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\DeliveryService\Interfaces\BagsInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BagsController extends Controller
{

    private BagsInterface $bagsRepository;
    private BusinessInterface $businessRepository;


    /**
     * @param BagsInterface $bagsRepository
     */
    public function __construct(BagsInterface $bagsRepository,BusinessInterface $businessRepository)
    {
        $this->businessRepository = $businessRepository;
        $this->bagsRepository = $bagsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function viewAllBags()
    {
        $businesses = $this->businessRepository->getBusinesses();
        $context = ["businesses"=>$businesses];
        return view('deliveryservice::bags.view_bags',$context);
    }
    public function addBag()
    {
        $businesses = $this->businessRepository->getBusinesses();
        $context = ["businesses"=>$businesses];
        return view('deliveryservice::bags.add_bag',$context);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeBag(Request $request,$partner_id)
    {
        $path = 'media/bags/qrcodes/' . time() . '.svg';
        $path = public_path('media/bags/qrcodes/' . time() . '.svg');

        $request->validate([
            'partner_id'=>['required'],
            'no_of_bags'=>['required','numeric']
        ]);


        try {
            for ($i=0; $i <$request->get("no_of_bags") ; $i++) { 
                $bag = $this->bagsRepository->addNewBag(qrCode: "",partner_id:$request->get("partner_id"), bagNumber: $request->get("bag_number"), bagSize: $request->get("bag_size"), bagType: $request->get("bag_size"), weight: $request->get("weight"), dimensions: $request->get("dimensions"));
                QrCode::size(400)
                    ->generate($bag->id, $path);
                $this->bagsRepository->updateBag(id: $bag->id,partner_id:"", qrCode: $path, bagNumber: "", bagSize: "", bagType: "", status: "", weight: "", dimensions: "");
            }
            
            return redirect()->route("add_new_bag")->with("Success", "Bags added successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            echo "error";
            dd($exception);
            // return redirect()->to("del_bags")->with("error", "Something went wrong!Contact support");
        }
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
