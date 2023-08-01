<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\BusinessService\Http\Controllers\BusinessInfo\BusinessInfoController;
use Modules\BusinessService\Http\Controllers\BusinessPricing\BusinessPricingController;
use Modules\BusinessService\Http\Controllers\BusinessRequests\NewRequestsController;

Route::prefix('businessservice')->group(function () {
    Route::get("home/", [\Modules\BusinessService\Http\Controllers\BusinessSettings\BusinessSettingsController::class, "index"])->name("business_home");

    Route::group(['prefix' => 'business_info/'], function () {
        Route::get("overview", [BusinessInfoController::class, "index"])->name("business_overview");
    });

    Route::group(['prefix' => 'onboarding/'], function () {
        Route::get("", [\Modules\BusinessService\Http\Controllers\Onboarding\BusinessOnboardingController::class, "index"])->name("business_onboarding");
        Route::post("add/", [\Modules\BusinessService\Http\Controllers\Onboarding\BusinessOnboardingController::class, "businessOnboarding"])->name("business_onboarding_add");
    });

    Route::group(['prefix' => 'new_requests/'], function () {
        Route::get("", [NewRequestsController::class, "getNewBusinessRequests"])->name("business_new_requests");
        Route::get("all-business", [NewRequestsController::class, "getAllBusinesses"])->name("get_all_businesses");

        Route::get("answer-new-request", [NewRequestsController::class, "answerNewRequest"])->name("answer_new_request");
        Route::post("send-docusign/", [NewRequestsController::class, "signDocument"])->name("docusign.sign");
        Route::get('connect-docusign/{id}', [NewRequestsController::class, 'connectDocusign'])->name('connect.docusign');
    });

    Route::group(['prefix' => 'pricing/'], function () {
        Route::get("delivery-slot-pricing", [BusinessPricingController::class, "deliverySlotBasePricing"])->name("delivery_slot_wise_base_pricing");
        Route::get("add-delivery-slot-base-pricing", [BusinessPricingController::class, "addDeliverySlotBasePricing"])->name("add_delivery_slot_base_pricing");
        Route::get("add-range-pricing", [BusinessPricingController::class, "addRangeBasePricing"])->name("add_range_base_pricing");
        Route::get("range-based-pricing", [BusinessPricingController::class, "rangeBasePricing"])->name("range_base_pricing");
        Route::get("get-base-range-pricing", [BusinessPricingController::class, "getCityRangeBasePrice"])->name("get_delivery_slots_of_city_in_base_price");
        Route::post("store-base-range-pricing", [BusinessPricingController::class, "storeCityRangeBasePrice"])->name("store_delivery_slots_of_city_in_base_price");

        Route::get("get-delivery-slots-of-city-in-base-price", [BusinessPricingController::class, "getDeliverySlotsOfCityInBasePrice"])->name("get_delivery_slots_of_city_in_base_price");
        Route::get("store-delivery-slot-pricing-in-base-price", [BusinessPricingController::class, "storeDeliverySlotPricingInBasePrice"])->name("store_delivery_slot_pricing_in_base_price");
    });



    Route::group(['prefix' => 'business-settings/'], function () {
    });
});
