<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\AboutUsListController;
use App\Http\Controllers\Api\AmenitiesController;
use App\Http\Controllers\Api\ContactInformationController;
use App\Http\Controllers\Api\FlowersController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\TressController;
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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verifyotp', [AuthController::class, 'verifyOTP']);
// Route::post('login', 'AuthController@login')->middleware('api');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    // Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::middleware('auth:api')->group(function () {
        Route::post('/update-user-form', [AuthController::class, 'updateUserDetails']);
        Route::post('/get-aboutus-list', [AboutUsListController::class, 'getAllAboutUsList']);
        Route::post('/get-charges-list', [AboutUsListController::class, 'getAllChargesList']);
        Route::post('/get-amenities-category', [AmenitiesController::class, 'getAmenitiesCategory']);
        Route::post('/get-amenities-list', [AmenitiesController::class, 'getAllAmenitiesList']);
        Route::post('/get-tress-list', [TressController::class, 'getTressList']);
        Route::post('/get-flowers-list', [FlowersController::class, 'getFlowersList']);
        

        
        
        
        });

});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     // return $request->user();
// });
