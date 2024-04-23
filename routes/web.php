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


    Route::get('/list-organizations', ['as' => 'list-organizations', 'uses' => 'App\Http\Controllers\Admin\Organization\OrganizationController@index']);
    Route::get('/add-organizations', ['as' => 'add-organizations', 'uses' => 'App\Http\Controllers\Admin\Organization\OrganizationController@add']);
    Route::post('/store-organizations', ['as' => 'store-organizations', 'uses' => 'App\Http\Controllers\Admin\Organization\OrganizationController@store']);
    Route::get('/edit-organizations/{id}', ['as' => 'edit-organizations', 'uses' => 'App\Http\Controllers\Admin\Organization\OrganizationController@edit']);
    Route::post('/update-organizations', ['as' => 'update-organizations', 'uses' => 'App\Http\Controllers\Admin\Organization\OrganizationController@update']);
    Route::any('/delete-organizations/{id}', ['as' => 'delete-organizations', 'uses' => 'App\Http\Controllers\Admin\Organization\OrganizationController@destroy']);
    Route::get('/organization-details/{id}', ['as' => 'organization-details', 'uses' => 'App\Http\Controllers\Admin\Organization\OrganizationController@details']);
    Route::get('/filter-employees/{id}', ['as' => 'filter-employees', 'uses' => 'App\Http\Controllers\Admin\Organization\OrganizationController@filterEmployees']);


    Route::get('/list-employees', ['as' => 'list-employees', 'uses' => 'App\Http\Controllers\Admin\Employees\EmployeesController@index']);
    Route::get('/add-employees', ['as' => 'add-employees', 'uses' => 'App\Http\Controllers\Admin\Employees\EmployeesController@add']);
    Route::post('/store-employees', ['as' => 'store-employees', 'uses' => 'App\Http\Controllers\Admin\Employees\EmployeesController@store']);
    Route::get('/edit-employees/{emp_id}', ['as' => 'edit-employees', 'uses' => 'App\Http\Controllers\Admin\Employees\EmployeesController@edit']);
    Route::post('/update-employees', ['as' => 'update-employees', 'uses' => 'App\Http\Controllers\Admin\Employees\EmployeesController@update']);
    Route::any('/delete-employees/{emp_id}', ['as' => 'delete-employees', 'uses' => 'App\Http\Controllers\Admin\Employees\EmployeesController@destroy']);

   
    Route::any('/list-roles', ['as' => 'list-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@index']);
    Route::any('/add-roles', ['as' => 'add-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@add']);
    Route::any('/store-roles', ['as' => 'store-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@store']);
    Route::any('/edit-roles/{id}', ['as' => 'edit-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@edit']);
    Route::any('/update-roles', ['as' => 'update-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@update']);
    Route::any('/delete-roles/{id}', ['as' => 'delete-roles', 'uses' => 'App\Http\Controllers\Admin\Roles\RolesController@destroy']);

   
});






