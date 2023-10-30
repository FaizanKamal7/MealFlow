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
use Modules\BusinessService\Http\Controllers\Onboarding\BusinessOnboardingController;
use Modules\BusinessService\Http\Controllers\PartnerPortal\CustomersController;
use Modules\FinanceService\Http\Controllers\WalletController;
use Modules\FinanceService\Http\Controllers\WalletTransactionController;




Route::group(['prefix' => 'businessservice/onboarding/'], function () {
    Route::get("", [BusinessOnboardingController::class, "index"])->name("business_onboarding");
    Route::post("add/", [BusinessOnboardingController::class, "businessOnboarding"])->name("business_onboarding_add");
    Route::get("pricing", [BusinessOnboardingController::class, "pricingCalculator"])->name("pricing_calculator");
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('businessservice')->group(function () {
        Route::get("", [\Modules\BusinessService\Http\Controllers\PartnerPortal\DashboardController::class, "dashboard"])->name("partner_dashboard");
        Route::get("deliveries/upload", [\Modules\BusinessService\Http\Controllers\PartnerPortal\DeliveriesController::class, "uploadDeliveriesByForm"])->name("partner_upload_deliveries");
        Route::get("deliveries", [\Modules\BusinessService\Http\Controllers\PartnerPortal\DeliveriesController::class, "viewAllDeliveries"])->name("partner_all_deliveries");
        Route::get("home/", [\Modules\BusinessService\Http\Controllers\BusinessSettings\BusinessSettingsController::class, "index"])->name("business_home");
        Route::get("customers", [\Modules\BusinessService\Http\Controllers\PartnerPortal\CustomersController::class, "viewAllCustomers"])->name("partner_all_customers");

        Route::group(['prefix' => 'business_info/'], function () {
            Route::get("overview/{business_id}", [BusinessInfoController::class, "index"])->name("business_overview");
        });

        Route::group(['prefix' => 'business_info/'], function () {
            Route::get("overview/{business_id}", [BusinessInfoController::class, "index"])->name("business_overview");
            Route::get("overview/send-contract-file/{business_id}", [BusinessInfoController::class, "sendContractFile"])->name("send_contract_file");
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
            Route::get("get-base-range-pricing", [BusinessPricingController::class, "getCityRangeBasePrice"])->name("get_base_range_pricing");
            Route::get("get-business-range-pricing", [BusinessPricingController::class, "getCitiesRangeBusinessPrice"])->name("get_business_range_pricing");
            Route::post("store-base-range-pricing", [BusinessPricingController::class, "storeCityRangeBasePrice"])->name("store_delivery_slots_of_city_in_base_price");
            Route::get("get-delivery-slots-of-city-in-base-price", [BusinessPricingController::class, "getDeliverySlotsOfCityInBasePrice"])->name("get_delivery_slots_of_city_in_base_price");
            Route::get("store-delivery-slot-pricing-in-base-price", [BusinessPricingController::class, "storeDeliverySlotPricingInBasePrice"])->name("store_delivery_slot_pricing_in_base_price");
        });


        Route::group(['prefix' => 'wallet/'], function () {
            Route::get("", [WalletController::class, "viewWallet"])->name("viewWallet");
            Route::group(['prefix' => 'credit/'], function () {
                Route::POST("store", [WalletTransactionController::class, "store"])->name("storeCredit");
                Route::get("paymentSuccess/{CHECKOUT_SESSION_ID}", [WalletTransactionController::class, "paymentSuccess"])->name("PaymentSuccess");
                Route::POST("store-bank-transfer", [WalletTransactionController::class, "storeBankTransferDetails"])->name("upload_bank_transfer_details");
                Route::get("pending-transactions", [WalletTransactionController::class, "pendingTransactionsView"])->name("pending_transactions");
                Route::POST("approve-pending-transaction", [WalletTransactionController::class, "approvePendingTransaction"])->name("approve_pending_transaction");
            });


            Route::group(['prefix' => 'business-settings/'], function () {
            });
        });


        Route::group(['prefix' => 'customers/'], function () {
            Route::get('/', [CustomersController::class, "viewAllCustomers"])->name("view_all_customers");
            Route::get('add/', [CustomersController::class, "viewAddCustomer"])->name("add_new_customer_view");
            Route::post('store/', [CustomersController::class, "storeNewCustomer"])->name("store_new_customer");
        });
    });
});
