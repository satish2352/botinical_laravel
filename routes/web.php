<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\StaticListController;
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


Route::get('/', function () {
    return view('admin.login');
});

Route::get('/plants', [StaticListController::class, 'index']);
Route::get('/mango', [StaticListController::class, 'mango']);
Route::get('/chickoo', [StaticListController::class, 'chickoo']);
Route::get('/banana', [StaticListController::class, 'banana']);
Route::get('/apple', [StaticListController::class, 'apple']);

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
    Route::get('/change-password', ['as' => '/change-password', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\ChangePassword@index']);
    Route::post('/update-password', ['as' => '/update-password', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\ChangePassword@updatePassword']);

    Route::get('/list-users', ['as' => 'list-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@index']);
    Route::get('/add-users', ['as' => 'add-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@addUsers']);
    Route::post('/add-users', ['as' => 'add-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@register']);
    Route::get('/edit-users/{edit_id}', ['as' => 'edit-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@editUsers']);
    Route::post('/update-users', ['as' => 'update-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@update']);
    Route::post('/delete-users', ['as' => 'delete-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@destroy']);
    Route::post('/show-users', ['as' => 'show-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@show']);
    Route::get('/cities', ['as' => 'cities', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@getCities']);
    Route::get('/states', ['as' => 'states', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@getState']);
    Route::post('/update-active-user', ['as' => 'update-active-user', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@updateOne']);

    // Route::get('/forms', ['as' => 'forms', 'uses' => 'App\Http\Controllers\Admin\Forms\FormsController@index']);
    Route::get('/admin-log-out', ['as' => 'log-out', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\LoginController@logout']);
    Route::post('/list-role-wise-permission', ['as' => 'list-role-wise-permission', 'uses' => 'App\Http\Controllers\Admin\Menu\RoleController@listRoleWisePermission']);

    //=====Roles Route======
Route::get('/list-role', ['as' => 'list-role', 'uses' => 'App\Http\Controllers\Admin\Master\RoleController@index']);
Route::get('/add-role', ['as' => 'add-role', 'uses' => 'App\Http\Controllers\Admin\Master\RoleController@add']);
Route::post('/add-role', ['as' => 'add-role', 'uses' => 'App\Http\Controllers\Admin\Master\RoleController@store']);
Route::get('/edit-role/{edit_id}', ['as' => 'edit-role', 'uses' => 'App\Http\Controllers\Admin\Master\RoleController@edit']);
Route::post('/update-role', ['as' => 'update-role','uses' => 'App\Http\Controllers\Admin\Master\RoleController@update']);
Route::post('/show-role', ['as' => 'show-role', 'uses' => 'App\Http\Controllers\Admin\Master\RoleController@show']);
Route::post('/delete-role', ['as' => 'delete-role', 'uses' => 'App\Http\Controllers\Admin\Master\RoleController@destroy']);
Route::post('/update-one-role', ['as' => 'update-one-role', 'uses' => 'App\Http\Controllers\Admin\Master\RoleController@updateOneRole']);


    Route::any('/list-amenities-category', ['as' => 'list-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@index']);
    Route::any('/add-amenities-category', ['as' => 'add-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@add']);
    Route::any('/store-amenities-category', ['as' => 'store-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@store']);
    Route::any('/edit-amenities-category/{edit_id}', ['as' => 'edit-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@edit']);
    Route::any('/update-amenities-category', ['as' => 'update-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@update']);
    Route::post('/delete-amenities-category', ['as' => 'delete-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@destroy']);
    Route::post('/update-one-amenities-category', ['as' => 'update-one-amenities-category', 'uses' => 'App\Http\Controllers\Admin\AmenitiesCategory\AmenitiesCategoryController@updateOneCategory']);

    Route::any('/list-tree-plant', ['as' => 'list-tree-plant', 'uses' => 'App\Http\Controllers\Admin\Master\TreePlantController@index']);
    Route::any('/add-tree-plant', ['as' => 'add-tree-plant', 'uses' => 'App\Http\Controllers\Admin\Master\TreePlantController@add']);
    Route::any('/store-tree-plant', ['as' => 'store-tree-plant', 'uses' => 'App\Http\Controllers\Admin\Master\TreePlantController@store']);
    Route::any('/edit-tree-plant/{edit_id}', ['as' => 'edit-tree-plant', 'uses' => 'App\Http\Controllers\Admin\Master\TreePlantController@edit']);
    Route::any('/update-tree-plant', ['as' => 'update-tree-plant', 'uses' => 'App\Http\Controllers\Admin\Master\TreePlantController@update']);
    Route::post('/delete-tree-plant', ['as' => 'delete-tree-plant', 'uses' => 'App\Http\Controllers\Admin\Master\TreePlantController@destroy']);
    Route::post('/update-one-tree-plant', ['as' => 'update-one-tree-plant', 'uses' => 'App\Http\Controllers\Admin\Master\TreePlantController@updateOneCategory']);


    Route::any('/list-roles', ['as' => 'list-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@index']);
    Route::any('/add-roles', ['as' => 'add-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@add']);
    Route::any('/store-roles', ['as' => 'store-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@store']);
    Route::any('/edit-roles/{id}', ['as' => 'edit-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@edit']);
    Route::any('/update-roles', ['as' => 'update-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@update']);
    Route::any('/delete-roles/{id}', ['as' => 'delete-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\Controller@destroy']);

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

    Route::post('/check-order-numbers', ['as' => 'check-order-numbers', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@checkOrderNumber']);
    Route::post('/update-order-number', ['as' => 'update-order-number', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@updateOrderNumber']);
    Route::get('/search-tree/{id}', ['as' => 'search-tree', 'uses' => 'App\Http\Controllers\Admin\Product\TressController@getTreeData']);

    // Route::get('/tree-data/{id}', [TreeController::class, 'getTreeData'])->name('get-tree-data');


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

    Route::any('/list-zone-co-ordinate', ['as' => 'list-zone-co-ordinate', 'uses' => 'App\Http\Controllers\Admin\ZoneCoOrdinate\ZoneCoOrdinateController@index']);
    Route::any('/add-zone-co-ordinate', ['as' => 'add-zone-co-ordinate', 'uses' => 'App\Http\Controllers\Admin\ZoneCoOrdinate\ZoneCoOrdinateController@add']);
    Route::any('/store-zone-co-ordinate', ['as' => 'store-zone-co-ordinate', 'uses' => 'App\Http\Controllers\Admin\ZoneCoOrdinate\ZoneCoOrdinateController@store']);
    Route::any('/edit-zone-co-ordinate/{edit_id}', ['as' => 'edit-zone-co-ordinate', 'uses' => 'App\Http\Controllers\Admin\ZoneCoOrdinate\ZoneCoOrdinateController@edit']);
    Route::any('/update-zone-co-ordinate', ['as' => 'update-zone-co-ordinate', 'uses' => 'App\Http\Controllers\Admin\ZoneCoOrdinate\ZoneCoOrdinateController@update']);
    Route::post('/show-zone-co-ordinate', ['as' => 'show-zone-co-ordinate', 'uses' => 'App\Http\Controllers\Admin\ZoneCoOrdinate\ZoneCoOrdinateController@show']);
    Route::post('/delete-zone-co-ordinate', ['as' => 'delete-zone-co-ordinate', 'uses' => 'App\Http\Controllers\Admin\ZoneCoOrdinate\ZoneCoOrdinateController@destroy']);
    Route::post('/update-active-zone-co-ordinate', ['as' => 'update-active-zone-co-ordinate', 'uses' => 'App\Http\Controllers\Admin\ZoneCoOrdinate\ZoneCoOrdinateController@updateOne']);


    Route::any('/list-amenities', ['as' => 'list-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@index']);
    Route::any('/add-amenities', ['as' => 'add-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@add']);
    Route::any('/store-amenities', ['as' => 'store-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@store']);
    Route::any('/edit-amenities/{edit_id}', ['as' => 'edit-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@edit']);
    Route::any('/update-amenities', ['as' => 'update-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@update']);
    Route::post('/show-amenities', ['as' => 'show-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@show']);
    Route::post('/delete-amenities', ['as' => 'delete-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@destroy']);
    Route::post('/update-active-amenities', ['as' => 'update-active-amenities', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@updateOne']);

    Route::post('/check-order-numbers', ['as' => 'check-order-numbers', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@checkOrderNumber']);
    Route::post('/update-order-number', ['as' => 'update-order-number', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@updateOrderNumber']);
    // Route::post('/reset-order-number', ['as' => 'reset-order-number', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@resetOrderNumbers']);
    Route::post('/reset-order-number', ['as' => 'reset-order-number', 'uses' => 'App\Http\Controllers\Admin\Product\AmenitiesController@resetOrderNumbers']);

    Route::any('/list-ticket', ['as' => 'list-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@index']);
    Route::any('/add-ticket', ['as' => 'add-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@add']);
    Route::any('/store-ticket', ['as' => 'store-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@store']);
    Route::any('/edit-ticket/{edit_id}', ['as' => 'edit-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@edit']);
    Route::any('/update-ticket', ['as' => 'update-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@update']);
    Route::post('/show-ticket', ['as' => 'show-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@show']);
    Route::post('/delete-ticket', ['as' => 'delete-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@destroy']);
    Route::post('/update-active-ticket', ['as' => 'update-active-ticket', 'uses' => 'App\Http\Controllers\Admin\Ticket\TicketController@updateOne']);

    Route::any('/list-charges', ['as' => 'list-charges', 'uses' => 'App\Http\Controllers\Admin\Charges\ChargesController@index']);
    Route::any('/add-charges', ['as' => 'add-charges', 'uses' => 'App\Http\Controllers\Admin\Charges\ChargesController@add']);
    Route::any('/store-charges', ['as' => 'store-charges', 'uses' => 'App\Http\Controllers\Admin\Charges\ChargesController@store']);
    Route::any('/edit-charges/{edit_id}', ['as' => 'edit-charges', 'uses' => 'App\Http\Controllers\Admin\Charges\ChargesController@edit']);
    Route::any('/update-charges', ['as' => 'update-charges', 'uses' => 'App\Http\Controllers\Admin\Charges\ChargesController@update']);
    Route::post('/show-charges', ['as' => 'show-charges', 'uses' => 'App\Http\Controllers\Admin\Charges\ChargesController@show']);
    Route::post('/delete-charges', ['as' => 'delete-charges', 'uses' => 'App\Http\Controllers\Admin\Charges\ChargesController@destroy']);
    Route::post('/update-active-charges', ['as' => 'update-active-charges', 'uses' => 'App\Http\Controllers\Admin\Charges\ChargesController@updateOne']);


    Route::any('/list-gallery', ['as' => 'list-gallery', 'uses' => 'App\Http\Controllers\Admin\Gallery\GalleryController@index']);
    Route::any('/add-gallery', ['as' => 'add-gallery', 'uses' => 'App\Http\Controllers\Admin\Gallery\GalleryController@add']);
    Route::any('/store-gallery', ['as' => 'store-gallery', 'uses' => 'App\Http\Controllers\Admin\Gallery\GalleryController@store']);
    Route::any('/edit-gallery/{edit_id}', ['as' => 'edit-gallery', 'uses' => 'App\Http\Controllers\Admin\Gallery\GalleryController@edit']);
    Route::any('/update-gallery', ['as' => 'update-gallery', 'uses' => 'App\Http\Controllers\Admin\Gallery\GalleryController@update']);
    Route::post('/show-gallery', ['as' => 'show-gallery', 'uses' => 'App\Http\Controllers\Admin\Gallery\GalleryController@show']);
    Route::post('/delete-gallery', ['as' => 'delete-gallery', 'uses' => 'App\Http\Controllers\Admin\Gallery\GalleryController@destroy']);
    Route::post('/update-active-gallery', ['as' => 'update-active-gallery', 'uses' => 'App\Http\Controllers\Admin\Gallery\GalleryController@updateOne']);

    Route::any('/list-aboutus', ['as' => 'list-aboutus', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsController@index']);
    Route::any('/add-aboutus', ['as' => 'add-aboutus', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsController@add']);
    Route::any('/store-aboutus', ['as' => 'store-aboutus', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsController@store']);
    Route::any('/edit-aboutus/{edit_id}', ['as' => 'edit-aboutus', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsController@edit']);
    Route::any('/update-aboutus', ['as' => 'update-aboutus', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsController@update']);
    Route::post('/show-aboutus', ['as' => 'show-aboutus', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsController@show']);
    Route::post('/delete-aboutus', ['as' => 'delete-aboutus', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsController@destroy']);
    Route::post('/update-active-aboutus', ['as' => 'update-active-aboutus', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsController@updateOne']);

    Route::any('/list-aboutus-element', ['as' => 'list-aboutus-element', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsElementController@index']);
    Route::any('/add-aboutu-element', ['as' => 'add-aboutus-element', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsElementController@add']);
    Route::any('/add-aboutus-element', ['as' => 'add-aboutus-element', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsElementController@add']);
    Route::any('/store-aboutus-element', ['as' => 'store-aboutus-element', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsElementController@store']);
    Route::any('/edit-aboutus-element/{edit_id}', ['as' => 'edit-aboutus-element', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsElementController@edit']);
    Route::any('/update-aboutus-element', ['as' => 'update-aboutus-element', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsElementController@update']);
    Route::post('/show-aboutus-element', ['as' => 'show-aboutus-element', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsElementController@show']);
    Route::post('/delete-aboutus-element', ['as' => 'delete-aboutus-element', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsElementController@destroy']);
    Route::post('/update-active-aboutus-element', ['as' => 'update-active-aboutus-element', 'uses' => 'App\Http\Controllers\Admin\AboutUs\AboutUsElementController@updateOne']);

    Route::any('/list-contact-enquiry', ['as' => 'list-contact-enquiry', 'uses' => 'App\Http\Controllers\Admin\Contact\ContactEnquiryController@index']);
    Route::post('/delete-contact-enquiry', ['as' => 'delete-contact-enquiry', 'uses' => 'App\Http\Controllers\Admin\Contact\ContactEnquiryController@destroy']);

    Route::any('/list-contact-information', ['as' => 'list-contact-information', 'uses' => 'App\Http\Controllers\Admin\Contact\ContactInformationController@index']);
    Route::any('/edit-contact-information/{edit_id}', ['as' => 'edit-contact-information', 'uses' => 'App\Http\Controllers\Admin\Contact\ContactInformationController@edit']);
    Route::any('/update-contact-information', ['as' => 'update-contact-information', 'uses' => 'App\Http\Controllers\Admin\Contact\ContactInformationController@update']);







    // =========================

    Route::any('/list-icon', ['as' => 'list-icon', 'uses' => 'App\Http\Controllers\Admin\Master\IconMasterController@index']);
    Route::any('/add-icon', ['as' => 'add-icon', 'uses' => 'App\Http\Controllers\Admin\Master\IconMasterController@add']);
    Route::any('/store-icon', ['as' => 'store-icon', 'uses' => 'App\Http\Controllers\Admin\Master\IconMasterController@store']);
    Route::any('/edit-icon/{edit_id}', ['as' => 'edit-icon', 'uses' => 'App\Http\Controllers\Admin\Master\IconMasterController@edit']);
    Route::any('/update-icon', ['as' => 'update-icon', 'uses' => 'App\Http\Controllers\Admin\Master\IconMasterController@update']);
    Route::post('/delete-icon', ['as' => 'delete-icon', 'uses' => 'App\Http\Controllers\Admin\Master\IconMasterController@destroy']);
    Route::post('/update-one-icon', ['as' => 'update-one-icon', 'uses' => 'App\Http\Controllers\Admin\Master\IconMasterController@updateOneCategory']);

    Route::any('/list-gallery-category', ['as' => 'list-gallery-category', 'uses' => 'App\Http\Controllers\Admin\Master\GalleryCategoryController@index']);
    Route::any('/add-gallery-category', ['as' => 'add-gallery-category', 'uses' => 'App\Http\Controllers\Admin\Master\GalleryCategoryController@add']);
    Route::any('/store-gallery-category', ['as' => 'store-gallery-category', 'uses' => 'App\Http\Controllers\Admin\Master\GalleryCategoryController@store']);
    Route::any('/edit-gallery-category/{edit_id}', ['as' => 'edit-gallery-category', 'uses' => 'App\Http\Controllers\Admin\Master\GalleryCategoryController@edit']);
    Route::any('/update-gallery-category', ['as' => 'update-gallery-category', 'uses' => 'App\Http\Controllers\Admin\Master\GalleryCategoryController@update']);
    Route::post('/delete-gallery-category', ['as' => 'delete-gallery-category', 'uses' => 'App\Http\Controllers\Admin\Master\GalleryCategoryController@destroy']);
    Route::post('/update-one-gallery-category', ['as' => 'update-one-gallery-category', 'uses' => 'App\Http\Controllers\Admin\Master\GalleryCategoryController@updateOneCategory']);


    Route::any('/list-home', ['as' => 'list-home', 'uses' => 'App\Http\Controllers\Admin\Home\HomeController@index']);
    Route::any('/add-home', ['as' => 'add-home', 'uses' => 'App\Http\Controllers\Admin\Home\HomeController@add']);
    Route::any('/store-home', ['as' => 'store-home', 'uses' => 'App\Http\Controllers\Admin\Home\HomeController@store']);
    Route::any('/edit-home/{edit_id}', ['as' => 'edit-home', 'uses' => 'App\Http\Controllers\Admin\Home\HomeController@edit']);
    Route::any('/update-home', ['as' => 'update-home', 'uses' => 'App\Http\Controllers\Admin\Home\HomeController@update']);
    Route::post('/show-home', ['as' => 'show-home', 'uses' => 'App\Http\Controllers\Admin\Home\HomeController@show']);
    Route::post('/delete-home', ['as' => 'delete-home', 'uses' => 'App\Http\Controllers\Admin\Home\HomeController@destroy']);
    Route::post('/update-active-home', ['as' => 'update-active-home', 'uses' => 'App\Http\Controllers\Admin\Home\HomeController@updateOne']);

});






