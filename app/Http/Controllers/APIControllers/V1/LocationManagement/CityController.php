<?php

namespace App\Http\Controllers\APIControllers\V1\LocationManagement;

use App\Http\Controllers\Controller;
use App\Interfaces\CityInterface;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Exception;

class CityController extends Controller
{
    use HttpResponses;

    private CityInterface $cityRepository;

    public function __construct(CityInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function getAllCities()
    {
        try {
            $data = $this->cityRepository->getFormattedActiveCities();

            return $this->success($data, "Cities retrieved successfully");
        } catch (Exception $exception) {
            return $this->error($exception, "Something went wrong please contact support");
        }
    }

    public function getCitiesOfState(Request $request)
    {
        $cities = [];
        if ($request) {
            $cities = $this->cityRepository->getCitiesOfState($request->state_id);
        }
        return response()->json($cities->toArray());
    }

    public function search(Request $request)
    {
        $searchTerm = $request->get('search');
        $cities = $this->cityRepository->searchCity($searchTerm);
        return response()->json($cities);
    }
}
