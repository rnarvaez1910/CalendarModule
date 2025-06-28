<?php
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
Route::get('/reservation', 'ReservationController@findAll');
Route::put('/reservation/{id}', 'ReservationController@update');
Route::post('/reservation/verify/{id}', 'ReservationController@verify');
Route::post('/reservation', 'ReservationController@create');
Route::delete('/reservation/{id}', 'ReservationController@delete');
Route::get('/reservation/report', 'ReservationController@report');
Route::get('/assets','AssetsController@findAllAssets');
Route::get('/assets/verify/{id}','AssetsController@verifyAvailability');