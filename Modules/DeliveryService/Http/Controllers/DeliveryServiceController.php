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
        return Excel::download(new DeliveryTemplateClass($data), 'delivery_template.xlsx');
    }

    public function uploadDeliveryView(Request $request){
        return view('deliveryservice::index');
    }

    public function uploadFile(Request $request){
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls'
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
}
