<?php

namespace Modules\DeliveryService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\DeliveryService\Http\Exports\DeliveryTemplateClass;
use Maatwebsite\Excel\Facades\Excel;
use Modules\DeliveryService\Http\Exports\ExcelImportClass;

class DeliveryServiceController extends Controller
{


    public function downloadExcel()
    {
        $data = [
            //            [
            //                'column1' => 'Value 1',
            //                'column2' => 'Value 2',

            //            ],
            //            [
            //                'column1' => 'Value 3',
            //                'column2' => 'Value 4',
            //            ],
        ];
        // return Excel::download(new DeliveryTemplateClass($data), 'delivery_template.xlsx');
        return;
    }

    public function uploadDeliveryView(Request $request)
    {
        return view('deliveryservice::index');
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls'
        ]);
        $file = $request->file('excel_file');

        try {

            // Load the Excel file using the import class
            // Excel::import(new ExcelImportClass, $file);

            return redirect()->back()->with('success', 'Data successfully imported.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('deliveryservice::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('deliveryservice::create');
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
        return view('deliveryservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('deliveryservice::edit');
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

    public function bulkAddView()
    {
        return view("deliveryservice::delivery.bulk");
    }
    public function addBulk(Request $request)
    {

        $customer_arr = $request->get('customer');
        $delivery_address_arr = $request->get('delivery_address');
        $delivery_slot_arr = $request->get('delivery_slot');
        $item_type_arr = $request->get('item_type');
        $special_instructions_arr = $request->get('special_instructions');
        $notes_arr = $request->get('notes');
        $cod_amount_arr = $request->get('cod_amount');

        // Assuming all arrays have the same length, you can use any of the arrays to determine the loop length
        $arrayLength = count($customer_arr);

        for ($i = 0; $i < $arrayLength; $i++) {
            $customer = $customer_arr[$i];
            $delivery_address = $delivery_address_arr[$i];
            $delivery_slot = $delivery_slot_arr[$i];
            $item_type = $item_type_arr[$i];
            $special_instructions = $special_instructions_arr[$i];
            $notes = $notes_arr[$i];
            $cod_amount = $cod_amount_arr[$i];

            // use these variables for repo function

            error_log("Customer: " . $customer);
            error_log("Delivery Address: " . $delivery_address);
            error_log("Delivery Slot: " . $delivery_slot);
            error_log("Item Type: " . $item_type);
            error_log("Special Instructions: " . $special_instructions);
            error_log("Notes: " . $notes);
            error_log("COD Amount: " . $cod_amount);
            error_log("****************");
        }
    }
}
