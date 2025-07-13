<?php
use App\Http\Controllers\ProfessorController;
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

// Reservation
Route::get('/reservation', 'ReservationController@findAll');
Route::put('/reservation/{id}', 'ReservationController@update');
Route::post('/reservation/verify/{id}', 'ReservationController@verify');
Route::post('/reservation', 'ReservationController@create');
Route::delete('/reservation/{id}', 'ReservationController@delete');
Route::get('/reservation/classroom', 'ReservationController@verifyClassroom');
Route::get('/reservation/report', 'ReservationController@report');


// Assets
Route::get('/assets', 'AssetsController@findAllAssets');
Route::get('/assets/verify/{id}', 'AssetsController@verifyAvailability');
Route::post('/assets', 'AssetsController@create');
Route::put('/assets', 'AssetsController@update');
Route::delete('/assets/{id}', 'AssetsController@destroy');

// Professors
Route::get('/professors', 'ProfessorController@getProfessors');
// Prueba
Route::get('/pruebas', 'PruebaController@findAll');
Route::post('/pruebas', 'PruebaController@create');
Route::put('/pruebas', 'PruebaController@update');
Route::delete('/pruebas/{id}', 'PruebaController@destroy');