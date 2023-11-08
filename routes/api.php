<?php

use App\Http\Controllers\APIControllers\AuthAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['cors', 'json.response']], function () {
    // Public Routes
    Route::post('/login', [AuthAPIController::class, 'login'])->name('login');
    Route::post('/verify', [AuthAPIController::class, 'verify'])->name('verify');
    Route::post('/register', [AuthAPIController::class, 'register'])->name('register');
});
Route::post('/logout', [AuthAPIController::class, 'logout'])->name('logout');

// Route::middleware('auth:api')->group(function () {
//     // Protected Routes
//     Route::post('/logout', [AuthAPIController::class, 'logout'])->name('logout');
// });

// 


Route::group(['middleware' => 'auth:api'], function () {

    Route::post('/logout', [AuthAPIController::class, 'logout']);


    Route::post('/logout', [AuthAPIController::class, 'logout']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
});





Route::get('/get-google-api-key', function () {
    return response()->json([
        'google_api_key' => config('services.google.key')
    ]);
});
