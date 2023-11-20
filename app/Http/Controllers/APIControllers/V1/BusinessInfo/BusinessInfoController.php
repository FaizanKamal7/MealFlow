<?php

namespace App\Http\Controllers\APIControllers\V1\BusinessInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\BusinessService\Interfaces\BranchCoverageInterface;
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\BusinessService\Interfaces\DeliverySlotPricingInterface;
use Modules\BusinessService\Interfaces\RangePricingInterface;

class BusinessInfoController extends Controller
{
    private $businessRepository;
    private $deliverySlotPricingRepository;
    private $rangePricingRepository;
    private $branchCoverageRepository;
    private $businessCustomereRepository;


    public function __construct(BusinessInterface $businessRepository, DeliverySlotPricingInterface $deliverySlotPricingRepository, RangePricingInterface $rangePricingRepository, BranchCoverageInterface $branchCoverageRepository, BusinessCustomerInterface $businessCustomereRepository)
    {
        $this->businessRepository = $businessRepository;
        $this->deliverySlotPricingRepository = $deliverySlotPricingRepository;
        $this->rangePricingRepository = $rangePricingRepository;
        $this->branchCoverageRepository = $branchCoverageRepository;
        $this->businessCustomereRepository = $businessCustomereRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getBusinessInfo(Request $request)
    {
        $user = Auth::guard('api')->user();
        dd($user->business);
        // $business = $this->businessRepository->getBusiness($business_id);

        // // Getting business delivery slot pricing 
        // $business_delivery_slot_pricing = $this->deliverySlotPricingRepository->getBusinessPricing($business_id);
        // if ($business_delivery_slot_pricing->isEmpty()) {
        //     $business_delivery_slot_pricing = $this->getBusinessBaseDeliverySlotPricing($business);
        // }

        // // Getting business range pricing 
        // $business_range_pricing = $this->rangePricingRepository->getBusinessPricing($business_id);
        // if ($business_range_pricing->isEmpty()) {
        //     $business_range_pricing = $this->getBusinessBaseRangePricing($business);
        // }
        // return view('businessservice::business_info.business_overview', ['business' =>  $business, 'business_delivery_slot_pricing' => $business_delivery_slot_pricing, 'business_range_pricing' => $business_range_pricing]);
    }

    // public function getBusinessBaseDeliverySlotPricing($business)
    // {
    //     $business_branches_coverages = $this->getBusinessCoveragesCities($business);

    //     $city_delivery_slot_wise_business_base_price = $business_branches_coverages->map(function ($branch_coverage) {
    //         $null_pricing = $branch_coverage->city->delivery_slot_pricings()->businessNull()->get();
    //         return $null_pricing ? $null_pricing : null;
    //     });
    //     return $city_delivery_slot_wise_business_base_price;
    // }

    // public function getBusinessBaseRangePricing($business)
    // {
    //     $business_branches_coverages = $this->getBusinessCoveragesCities($business);
    //     $city_range_wise_business_base_price = $business_branches_coverages->map(function ($branch_coverage) {
    //         $null_pricing = $branch_coverage->city->range_pricings()->businessNull()->get();
    //         return $null_pricing ? $null_pricing : null;
    //     });
    //     return $city_range_wise_business_base_price;
    // }

    // public function getBusinessCoveragesCities($business)
    // {
    //     $unique_city_ids = $business->branches->flatMap(function ($branch) {
    //         return $branch->branch_coverages->pluck('city_id');
    //     })->unique();

    //     $business_branches_coverages = $this->branchCoverageRepository->getUniqueBranchCoverageBasedOnCities($unique_city_ids);

    //     return $business_branches_coverages;
    // }




}
