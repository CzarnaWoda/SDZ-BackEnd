<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InformationController;



Route::group(['prefix' => 'v1' , 'namespace' => 'App\Http\Controllers'], function () {
    // Trasy dostępne dla roli "user"
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('invoices', InvoiceController::class);
        Route::apiResource('pets', PetController::class);
});
Route::group(['prefix' => 'v1' , 'middleware' => ['logged'] ,'namespace' => 'App\Http\Controllers'], function () {

    Route::apiResource('users', UserController::class);
});

Route::get('pets' ,'App\Http\Controllers\PetController@all')->middleware('logged');
Route::post('/login', [AuthController::class, 'login']);
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');

});
Route::post('pet/store', 'App\Http\Controllers\PetController@store')->middleware('logged');
Route::group(['prefix' => 'v1', 'middleware' => ['logged']], function () {
    Route::post('information/store', [InformationController::class, 'store']);
    Route::put('information/update', [InformationController::class, 'update']);
    Route::get('information/get', [InformationController::class, 'get']);

});
Route::post('login', 'App\Http\Controllers\AuthController@login')->middleware('api');
Route::post('register', 'App\Http\Controllers\AuthController@register');

Route::get('me', 'App\Http\Controllers\AuthController@me')->middleware('logged');

Route::get('validate', 'App\Http\Controllers\AuthController@validate')->middleware('logged');

Route::get('admin', 'App\Http\Controllers\AuthController@isAdmin')->middleware('logged');

Route::post('invoice/store', 'App\Http\Controllers\InvoiceController@store')->middleware('logged');

Route::get('invoice/user', 'App\Http\Controllers\InvoiceController@invoicesByUserId')->middleware('logged');

Route::delete('invoice/destroy', 'App\Http\Controllers\InvoiceController@destroy')->middleware('logged');


Route::post('grantAdmin', 'App\Http\Controllers\AuthController@grantAdmin')->middleware('logged');
Route::post('removeAdmin', 'App\Http\Controllers\AuthController@removeAdmin')->middleware('logged');
Route::post('removeUser', 'App\Http\Controllers\AuthController@removeUser')->middleware('logged');
