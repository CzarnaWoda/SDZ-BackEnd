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

Route::post('/login', [AuthController::class, 'login']);
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

});
Route::group(['prefix' => 'api/v1', 'middleware' => ['auth.jwt']], function () {
    Route::post('information/store', [InformationController::class, 'store']);
    Route::put('information/update', [InformationController::class, 'update']);
    Route::get('information/get', [InformationController::class, 'get']);

});
Route::post('login', 'App\Http\Controllers\AuthController@login')->middleware('api');

