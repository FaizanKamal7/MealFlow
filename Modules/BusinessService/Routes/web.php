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

use Modules\BusinessService\Http\Controllers\BusinessPricing\BusinessPricingController;
use Modules\BusinessService\Http\Controllers\BusinessRequests\NewRequestsController;

Route::prefix('businessservice')->group(function () {
    Route::get("home/", [\Modules\BusinessService\Http\Controllers\BusinessSettings\BusinessSettingsController::class, "index"])->name("business_home");

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
        Route::get("", [BusinessPricingController::class, "index"])->name("business_pricing_home");
    });



    Route::group(['prefix' => 'business-settings/'], function () {
    });
});
