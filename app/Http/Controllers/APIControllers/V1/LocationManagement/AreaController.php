<?php

namespace App\Http\Controllers\APIControllers\V1\LocationManagement;

use App\Http\Controllers\Controller;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Exception;

class AreaController extends Controller
{
    use HttpResponses;
    private $areaRepository;

    public function __construct(AreaInterface $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function getAllAreas()
    {
        try {
            $data = $this->areaRepository->getFormattedAreas();
            return $this->success($data, "Cities retrieved successfully");
        } catch (Exception $exception) {
            return $this->error($exception, "Something went wrong please contact support");
        }
    }
}
