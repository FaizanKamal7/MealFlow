<?php

namespace Modules\HRManagement\Http\Controllers\Awards;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Interfaces\AwardsInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class AwardsController extends Controller
{
    private AwardsInterface $awardsRepository;

    /**
     * @param AwardsInterface $awardsRepository
     */
    public function __construct(AwardsInterface $awardsRepository)
    {
        $this->awardsRepository = $awardsRepository;
    }

    /**
     * Display a listing of the resource.

     */
    public function viewAwards()
    {
        abort_if(Gate::denies('view_award'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $awards = $this->awardsRepository->getAwards();
        return view('hrmanagement::awards.awards',["awards"=>$awards]);
    }

    /**
     * Show the form for creating a new resource.

     */
    public function createAward(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request

     */
    public function storeAward(Request $request)
    {
        abort_if(Gate::denies('add_award'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $icon = $request->get("icon");
            $title = $request->get("title");
            $amount = $request->get("amount");
            $description = $request->get("description");
            $this->awardsRepository->createAward($title,$icon,$description,$amount);
            return redirect()->route("hr_awards")->with("success", "Award added successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_awards")->with("error", "Something went wrong! Contact support");
        }
    }

    /**
     * Show the specified resource.
     * @param int $id

     */
    public function show($id)
    {
        return view('hrmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id

     */
    public function editAward($id)
    {
        abort_if(Gate::denies('edit_award'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $award = $this->awardsRepository->getAward($id);
            return response()->json(["award"=>$award], 200);
        }
        catch (Exception $exception){
            Log::error($exception);
            return response()->json(["award"=>null], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request

     */
    public function updateAward(Request $request)
    {
        abort_if(Gate::denies('update_award'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $icon = null;
            if ($request->has("icon")){
                $icon = $request->get("icon");
            }
            $id = $request->get("id");
            $title = $request->get("title");
            $amount = $request->get("amount");
            $description = $request->get("description");

            $this->awardsRepository->editAward(id:$id,title: $title,amount: $amount,description: $description,icon: $icon);
            return redirect()->route("hr_awards")->with("success", "Award updated successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_awards")->with("error", "Something went wrong! Contact support");
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyAward($id)
    {
        abort_if(Gate::denies('delete_award'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->awardsRepository->deleteAward($id);
            return redirect()->route("hr_awards")->with("success", "Award deleted successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_awards")->with("error", "Something went wrong! Contact support");
        }
    }
}
