<?php

use App\Http\Controllers\APIControllers\AuthController;
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
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/verify', [AuthController::class, 'verify'])->name('verify');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware('auth:api')->group(function () {
//     // Protected Routes
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });

// 

// Route::group(['middleware'=>'auth:sanctum'],function (){

//     Route::post('/logout',[AuthController::class,'logout']);

// });


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

// });





Route::get('/get-google-api-key', function () {
    return response()->json([
        'google_api_key' => config('services.google.key')
    ]);
});
