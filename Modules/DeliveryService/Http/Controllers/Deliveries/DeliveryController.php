<?php

namespace Modules\DeliveryService\Http\Controllers\Deliveries;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\BusinessService\Entities\Customer;
use Modules\BusinessService\Entities\CustomerAddress;
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;
use Modules\DeliveryService\Http\Exports\DeliveryTemplateClass;
use Modules\DeliveryService\Http\Exports\ExcelImportClass;

class DeliveryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function viewAllDeliveries()
    {
        return view('deliveryservice::deliveries.deliveries');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function uploadDeliveries()
    {
        return view('deliveryservice::deliveries.upload_delivery');
    }

    public function uploadDeliveriesByForm(Request $request)
    {
        $customers = $request->get("customer");
        $addresses = $request->get("delivery_address");
        $deliverySlots = $request->get("delivery_slot");
        $itemTypes = $request->get("item_type");
        $instructions = $request->get("special_instructions");
        $notes = $request->get("notes");
        $codAmounts = $request->get("cod_amount");

        $totalRecords =  count($customers);
        for ($i = 0; $i < $totalRecords; $i++) {
            $customer = $customers[$i];
            $address = $addresses[$i];
            $deliverySlot = $deliverySlots[$i];
            $itemType = $itemTypes[$i];
            $instruction = $instructions[$i];
            $note = $notes[$i];
            $codAmount = $codAmounts[$i];

            //TODO:: store data into database

        }
        return redirect()->route("upload_deliveries")->with("success", "Deliveries uploaded successfully");
    }

    public function generateAndDownloadDeliveryTemplate(Request $request)
    {
        $data = [];
        return Excel::download(new DeliveryTemplateClass($data, $request->get("total_deliveries")), 'delivery_template.xlsx');
    }

    public function uploadDeliveriesByExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv'
        ]);
        $file = $request->file('excel_file');

        try {
            // Load the Excel file using the import class
            Excel::import(new ExcelImportClass, $file);
            return redirect()->back()->with('success', 'Data successfully imported.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
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
        return view('deliveryservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function edit($id)
    {
        return view('deliveryservice::edit');
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

    //TODO::This function (getAddresses) will be moved to CustomerAddressController

    public function getAddresses(Request $request)
    {
        $selectedCustomer = $request->input('customer');
        // Retrieve delivery addresses for the selected customer
        $deliveryAddresses = CustomerAddress::where('customer', $selectedCustomer)->pluck('address');

        return response()->json(['deliveryAddresses' => $deliveryAddresses]);
    }
}
