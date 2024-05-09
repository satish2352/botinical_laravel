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

    Route::any('/list-departments', ['as' => 'list-departments', 'uses' => 'App\Http\Controllers\Admin\Departments\DepartmentController@index']);
    Route::any('/add-departments', ['as' => 'add-departments', 'uses' => 'App\Http\Controllers\Admin\Departments\DepartmentController@add']);
    Route::any('/store-departments', ['as' => 'store-departments', 'uses' => 'App\Http\Controllers\Admin\Departments\DepartmentController@store']);
    Route::any('/edit-departments/{id}', ['as' => 'edit-departments', 'uses' => 'App\Http\Controllers\Admin\Departments\DepartmentController@edit']);
    Route::any('/update-departments', ['as' => 'update-departments', 'uses' => 'App\Http\Controllers\Admin\Departments\DepartmentController@update']);
    Route::any('/delete-departments/{id}', ['as' => 'delete-departments', 'uses' => 'App\Http\Controllers\Admin\Departments\DepartmentController@destroy']);
   
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
    Route::any('/delete-tress/{id}', ['as' => 'delete-tress', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@destroy']);
    Route::post('/update-active-tress', ['as' => 'update-active-tress', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@updateOne']);

});






