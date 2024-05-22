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
use App\Http\Controllers\Api\FacilitiesController;
use App\Http\Controllers\Api\ZoneAreaController;

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
        Route::post('/get-aboutus-element-list', [AboutUsListController::class, 'getAllAboutUsElementList']);
        Route::post('/get-charges-list', [AboutUsListController::class, 'getAllChargesList']);
      
        Route::post('/get-ticket-list', [AboutUsListController::class, 'getAllTicketList']);
        

         // =========Amenities===================

        Route::post('/get-amenities-category', [AmenitiesController::class, 'getAmenitiesCategory']);
        Route::post('/get-amenities-list', [AmenitiesController::class, 'getAllAmenitiesList']);
        Route::post('/get-amenities-audio', [AmenitiesController::class, 'getParticularAmenitiesAudio']);
        Route::post('/get-amenities-video', [AmenitiesController::class, 'getParticularAmenitiesVideo']);
         // =========Tress===================
        Route::post('/get-tress-list', [TressController::class, 'getTressList']);
        Route::post('/get-tress-audio', [TressController::class, 'getParticularTressAudio']);
        Route::post('/get-tress-video', [TressController::class, 'getParticularTressVideo']);

        // =========Flowers===================
        Route::post('/get-flowers-list', [FlowersController::class, 'getFlowersList']);
        Route::post('/get-flowers-audio', [FlowersController::class, 'getParticularFlowersAudio']);
        Route::post('/get-flowers-video', [FlowersController::class, 'getParticularFlowersVideo']);

        // =========ZoneArea===================
        Route::post('/get-zone-area', [ZoneAreaController::class, 'getZoneArea']);
        Route::post('/get-zone-area-audio', [ZoneAreaController::class, 'getParticularZoneAreaAudio']);
        Route::post('/get-zone-area-video', [ZoneAreaController::class, 'getParticularZoneAreaVideo']);

        Route::post('/get-gallery', [GalleryController::class, 'getGallery']);

        Route::post('/get-facilities', [FacilitiesController::class, 'getFacilities']);
          
        Route::post('/add-contactus-form', [ContactInformationController::class, 'addContactUs']);
      
        Route::post('/get-contact-information', [ContactInformationController::class, 'getContactInformation']);
        

        });

});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     // return $request->user();
// });
