<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('admin.login');
});


Route::get('/clear', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('clear-compiled');
    return 'Cache cleared'; // You can return any response you want here
});

Route::get('/login', ['as' => 'login', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\LoginController@index']);
Route::post('/submitLogin', ['as' => 'submitLogin', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\LoginController@submitLogin']);
Route::get('/register', ['as' => 'register', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@index']);

Route::group(['middleware' => ['admin']], function () {

    Route::get('/dashboard', ['as' => '/dashboard', 'uses' => 'App\Http\Controllers\Admin\Dashboard\DashboardController@index']);
    // Route::get('/forms', ['as' => 'forms', 'uses' => 'App\Http\Controllers\Admin\Forms\FormsController@index']);
    Route::get('/admin-log-out', ['as' => 'log-out', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\LoginController@logout']);

    Route::any('/list-amenities-category', ['as' => 'list-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@index']);
    Route::any('/add-amenities-category', ['as' => 'add-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@add']);
    Route::any('/store-amenities-category', ['as' => 'store-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@store']);
    Route::any('/edit-amenities-category/{edit_id}', ['as' => 'edit-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@edit']);
    Route::any('/update-amenities-category', ['as' => 'update-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@update']);
    Route::post('/delete-amenities-category', ['as' => 'delete-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@destroy']);
    Route::post('/update-one-amenities-category', ['as' => 'update-one-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@updateOneCategory']);


    Route::any('/list-roles', ['as' => 'list-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@index']);
    Route::any('/add-roles', ['as' => 'add-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@add']);
    Route::any('/store-roles', ['as' => 'store-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@store']);
    Route::any('/edit-roles/{id}', ['as' => 'edit-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@edit']);
    Route::any('/update-roles', ['as' => 'update-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@update']);
    Route::any('/delete-roles/{id}', ['as' => 'delete-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@destroy']);

    Route::get('/list-district', ['as' => 'list-district', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@index']);
    Route::get('/add-district', ['as' => 'add-district', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@addDistrict']);
    Route::post('/add-district', ['as' => 'add-district', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@addDistrictInsert']);
    Route::post('/update-active-dist', ['as' => 'update-active-dist', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@updateOneDistrict']);
    Route::get('/edit-district/{edit_id}', ['as' => 'edit-district', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@editDistrict']);
    Route::post('/update-district', ['as' => 'update-district', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@updateDistrict']);
    Route::get('/delete-district/{edit_id}', ['as' => 'delete-district', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@deleteDistrict']);

    Route::get('/list-taluka', ['as' => 'list-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@getTalukaList']);
    Route::get('/add-taluka', ['as' => 'add-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@addTaluka']);
    Route::post('/add-taluka', ['as' => 'add-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@addTalukaInsert']);
    Route::post('/update-active-taluka', ['as' => 'update-active-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@updateOneTaluka']);
    Route::get('/edit-taluka/{edit_id}', ['as' => 'edit-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@editTaluka']);
    Route::post('/update-taluka', ['as' => 'update-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@updateTaluka']);
    Route::get('/delete-taluka/{edit_id}', ['as' => 'delete-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@deleteTaluka']);

    Route::get('/list-village', ['as' => 'list-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@getVillageList']);
    Route::get('/add-village', ['as' => 'add-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@addVillage']);
    Route::post('/add-village', ['as' => 'add-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@addVillageInsert']);
    Route::post('/update-active-village', ['as' => 'update-active-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@updateOneVillage']);
    Route::get('/edit-village/{edit_id}', ['as' => 'edit-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@editVillage']);
    Route::post('/update-village', ['as' => 'update-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@updateVillage']);
    Route::post('/delete-village/{edit_id}', ['as' => 'delete-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@deleteVillage']);

    Route::get('/district', ['as' => 'district', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@getDistrict']);
    Route::get('/taluka', ['as' => 'taluka', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@getTaluka']);
    Route::get('/village', ['as' => 'village', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@getVillage']);

    Route::any('/list-tress', ['as' => 'list-tress', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@index']);
    Route::any('/add-tress', ['as' => 'add-tress', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@add']);
    Route::any('/store-tress', ['as' => 'store-tress', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@store']);
    Route::any('/edit-tress/{edit_id}', ['as' => 'edit-tress', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@edit']);
    Route::any('/update-tress', ['as' => 'update-tress', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@update']);
    Route::post('/show-tress', ['as' => 'show-tress', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@show']);
    Route::post('/delete-tress', ['as' => 'delete-tress', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@destroy']);
    Route::post('/update-active-tress', ['as' => 'update-active-tress', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@updateOne']);

    Route::any('/list-flowers', ['as' => 'list-flowers', 'uses' => 'App\Http\Controllers\Admin\Product\FlowersController@index']);
    Route::any('/add-flowers', ['as' => 'add-flowers', 'uses' => 'App\Http\Controllers\Admin\Product\FlowersController@add']);
    Route::any('/store-flowers', ['as' => 'store-flowers', 'uses' => 'App\Http\Controllers\Admin\Product\FlowersController@store']);
    Route::any('/edit-flowers/{edit_id}', ['as' => 'edit-flowers', 'uses' => 'App\Http\Controllers\Admin\Product\FlowersController@edit']);
    Route::any('/update-flowers', ['as' => 'update-flowers', 'uses' => 'App\Http\Controllers\Admin\Product\FlowersController@update']);
    Route::post('/show-flowers', ['as' => 'show-flowers', 'uses' => 'App\Http\Controllers\Admin\Product\FlowersController@show']);
    Route::post('/delete-flowers', ['as' => 'delete-flowers', 'uses' => 'App\Http\Controllers\Admin\Product\FlowersController@destroy']);
    Route::post('/update-active-flowers', ['as' => 'update-active-flowers', 'uses' => 'App\Http\Controllers\Admin\Product\FlowersController@updateOne']);


    Route::any('/list-zone-area', ['as' => 'list-zone-area', 'uses' => 'App\Http\Controllers\Admin\Product\ZoneAreaController@index']);
    Route::any('/add-zone-area', ['as' => 'add-zone-area', 'uses' => 'App\Http\Controllers\Admin\Product\ZoneAreaController@add']);
    Route::any('/store-zone-area', ['as' => 'store-zone-area', 'uses' => 'App\Http\Controllers\Admin\Product\ZoneAreaController@store']);
    Route::any('/edit-zone-area/{edit_id}', ['as' => 'edit-zone-area', 'uses' => 'App\Http\Controllers\Admin\Product\ZoneAreaController@edit']);
    Route::any('/update-zone-area', ['as' => 'update-zone-area', 'uses' => 'App\Http\Controllers\Admin\Product\ZoneAreaController@update']);
    Route::post('/show-zone-area', ['as' => 'show-zone-area', 'uses' => 'App\Http\Controllers\Admin\Product\ZoneAreaController@show']);
    Route::post('/delete-zone-area', ['as' => 'delete-zone-area', 'uses' => 'App\Http\Controllers\Admin\Product\ZoneAreaController@destroy']);
    Route::post('/update-active-zone-area', ['as' => 'update-active-zone-area', 'uses' => 'App\Http\Controllers\Admin\Product\ZoneAreaController@updateOne']);


    Route::any('/list-amenities', ['as' => 'list-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@index']);
    Route::any('/add-amenities', ['as' => 'add-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@add']);
    Route::any('/store-amenities', ['as' => 'store-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@store']);
    Route::any('/edit-amenities/{edit_id}', ['as' => 'edit-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@edit']);
    Route::any('/update-amenities', ['as' => 'update-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@update']);
    Route::post('/show-amenities', ['as' => 'show-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@show']);
    Route::post('/delete-amenities', ['as' => 'delete-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@destroy']);
    Route::post('/update-active-amenities', ['as' => 'update-active-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@updateOne']);


    Route::any('/list-ticket', ['as' => 'list-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@index']);
    Route::any('/add-ticket', ['as' => 'add-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@add']);
    Route::any('/store-ticket', ['as' => 'store-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@store']);
    Route::any('/edit-ticket/{edit_id}', ['as' => 'edit-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@edit']);
    Route::any('/update-ticket', ['as' => 'update-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@update']);
    Route::post('/show-ticket', ['as' => 'show-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@show']);
    Route::post('/delete-ticket', ['as' => 'delete-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@destroy']);
    Route::post('/update-active-ticket', ['as' => 'update-active-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@updateOne']);

    
});






