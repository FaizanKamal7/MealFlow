<?php

namespace Modules\HRManagement\Http\Controllers\Appreciation;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Http\Helper\Helper;
use Modules\HRManagement\Interfaces\AppreciationInterface;
use Modules\HRManagement\Interfaces\AwardsInterface;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Symfony\Component\HttpFoundation\Response;

class AppreciationController extends Controller
{
    //Meta Data

    private AppreciationInterface $appreciationRepository;
    private EmployeesInterface $employeesRepository;
    private AwardsInterface $awardsRepository;

    private Helper $helper;

    /**
     * @param AppreciationInterface $appreciationRepository
     */
    public function __construct(AppreciationInterface $appreciationRepository, Helper $helper, EmployeesInterface $employeesRepository, AwardsInterface $awardsRepository)
    {
        $this->appreciationRepository = $appreciationRepository;
        $this->employeesRepository = $employeesRepository;
        $this->awardsRepository = $awardsRepository;
        $this->helper = $helper;
    }
    //View
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function viewAppreciations(Request $request)
    {
        abort_if(Gate::denies('view_appreciation'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            $appreciations = $this->appreciationRepository->getAppreciations();
            return view('hrmanagement::appreciation.appreciations',["appreciations"=>$appreciations]);
        }
        catch (Exception $exception){
            Log::error($exception);
            return view('hrmanagement::appreciation.appreciations',["appreciations"=>$appreciations])->with('error',"Something went wrong");
        }
    }

    //Add
    /**
     * Show the form for creating a new resource.
     */
    public function createAppreciation()
    {
        abort_if(Gate::denies('add_appreciation'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            $employees = $this->employeesRepository->getEmployees();
            $awards = $this->awardsRepository->getAwards();
            return view('hrmanagement::appreciation.add_appreciation', ["employees"=>$employees, "awards"=>$awards]);
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route('hr_appreciations')->with('error',"Something went wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeAppreciation(Request $request)
    {
        try {
            $employee = $request->get("employee_id");
            $award = $request->get("award_id");
            $amount = $request->get("amount");
            $date = $request->get("date");
            $note = $request->get("note");
            $picture = null;
            if ($file = $request->file("picture")){
                $picture = $this->helper->storeFile($file, "appreciations");
            }
            $this->appreciationRepository->createAppreciation($date,$employee,$note,$picture,$amount,$award);
            return redirect()->route("hr_appreciations")->with("success", "Appreciation added successfully");

        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_appreciations_add")->with("error", "Something went wrong! Contact support");
        }
    }

    //Edit

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editAppreciation($id)
    {
        abort_if(Gate::denies('edit_appreciation'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $appreciation = $this->appreciationRepository->getAppreciation($id);
            $awards = $this->awardsRepository->getAwards();
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route('hr_appreciations')->with("error", "Something went wrong! Contact support");
        }
        return view('hrmanagement::appreciation.edit_appreciation', ["appreciation"=>$appreciation, "awards"=>$awards]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param  $id
     */
    public function updateAppreciation(Request $request, $id)
    {
        abort_if(Gate::denies('update_appreciation'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $award = null;
            $amount = null;
            $date = null;
            $note = null;
            if ($request->has("award_id")){
                $award = $request->get("award_id");
            }
            if ($request->has("amount")){
                $amount = $request->get("amount");
            }
            if ($request->has("date")){
                $date = $request->get("date");
            }
            if ( $request->has("note")){
                $note = $request->get("note");
            }

            $picture = null;
            if ($file = $request->file("picture")){
                $picture = $this->helper->storeFile($file, "appreciations");
            }

            $this->appreciationRepository->updateAppreciation(id:$id,date: $date,note: $note,picture: $picture,amount: $amount,awardId: $award);
            return redirect()->route("hr_appreciations")->with("success", "Appreciation updated successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_appreciations")->with("error", "Something went wrong! Contact support");
        }
    }

    //Delete
    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyAppreciation($id)
    {
        abort_if(Gate::denies('delete_appreciation'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->appreciationRepository->deleteAppreciation($id);
            return redirect()->route("hr_appreciations")->with("success", "Appreciation deleted successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_appreciations")->with("error", "Something went wrong! Contact support");
        }
    }
}
