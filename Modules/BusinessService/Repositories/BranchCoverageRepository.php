<?php

namespace Modules\BusinessService\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\BusinessService\Entities\Branch;
use Modules\BusinessService\Entities\BranchCoverage;
use Modules\BusinessService\Entities\BranchCoverageDeliverySlots;
use Modules\BusinessService\Interfaces\BranchCoverageInterface;

class BranchCoverageRepository implements BranchCoverageInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function createBranchCoverage(
        $active_status,
        $city_id,
        $state,
        $country,
        $branch_id,
        $area_id = null,
    ) {
        $branch_coverage =  BranchCoverage::create([
            "active_status" => $active_status,
            "area_id" => $area_id,
            "city_id" => $city_id,
            "state_id" => $state,
            "country_id" => $country,
            "branch_id" => $branch_id,
        ]);
        $branch_coverage->save();
        return $branch_coverage;
    }

    public function getBranchCoverage()
    {
        return BranchCoverage::all();
    }

    public function getUniqueBranchCoverageBasedOnCities($city_ids)
    {
        // BranchCoverage::whereIn('city_id', $uniqueCityIds)

        $first_coverages = BranchCoverage::whereIn('city_id', $city_ids)->groupBy('city_id')
            ->select(DB::raw('MIN(id) as id'))
            ->get();
        return BranchCoverage::whereIn('id', $first_coverages->pluck('id'))->get();
    }
}
