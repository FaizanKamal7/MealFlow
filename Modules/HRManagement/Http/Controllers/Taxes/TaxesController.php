<?php

namespace Modules\HRManagement\Http\Controllers\Taxes;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Interfaces\TaxesInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class TaxesController extends Controller
{
    private TaxesInterface $taxesRepository;

    /**
     * @param TaxesInterface $taxesRepository
     */
    public function __construct(TaxesInterface $taxesRepository)
    {
        $this->taxesRepository = $taxesRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function viewTaxes()
    {
        abort_if(Gate::denies('view_taxes'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $taxes = $this->taxesRepository->getTaxes();
        return view('hrmanagement::taxes.taxes', ["taxes" => $taxes]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeTax(Request $request)
    {
        abort_if(Gate::denies('add_taxes'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $taxes = $this->taxesRepository->getTaxes();
        try {
            $name = $request->get('name');
            $amount_percentage = $request->get('amount_percentage');
            $this->taxesRepository->createTax(name: $name, amountPercentage: $amount_percentage);

            return redirect()->route('hr_taxes', ["taxes" => $taxes])->with("success", "Tax added successfully");
        } catch (Exception $exception) {
            error_log("Error in addTax : " . $exception);
            Log::error($exception);

            return redirect()->route('hr_taxes', ["taxes" => $taxes])->with('error', "Something went wrong");
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editTax($id)
    {
        abort_if(Gate::denies('edit_taxes'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            $tax = $this->taxesRepository->getTax($id);
            return response()->json(["tax"=>$tax], 200);
        }
        catch (Exception $exception)
        {
            Log::error($exception);
            error_log("Error in edit tax ajax call : ".$exception);
            return response()->json(["tax"=>null], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return mixed
     */
    public function updateTax(Request $request)
    {
        abort_if(Gate::denies('update_taxes'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            $id = $request->get('id');
            $name = $request->get('edit_name');
            $amount_percentage = $request->get('edit_amount_percentage');
            $this->taxesRepository->updateTax(id: $id, name: $name, amountPercentage: $amount_percentage);
            return redirect()->route("hr_taxes")->with("success","Changes saved successfully.");
        }
        catch (Exception $exception){
            Log::error($exception);
            error_log("Error in Update Tax : ".$exception);
            return redirect()->route("hr_taxes")->with("error","Something went wrong.");
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyTax($id)
    {
        abort_if(Gate::denies('delete_taxes'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            $this->taxesRepository->deleteTax($id);
            return redirect()->route('hr_taxes')->with("success","Tax deleted successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            error_log("Error in Tax delete : ".$exception);
            return redirect()->route('hr_taxes')->with("error","Something went wrong");
        }
    }
}
