<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/diegoespato', function() { 
    return view('practicas');
});

Route::get('/login', function () {
    $isAdmin = false;
    return view('login', compact('isAdmin'));
});

Route::get('/', function () {
    $isAdmin = false;
    return view('login', compact('isAdmin'));
});

Route::get('/becario', function () {
    $isAdmin = false;
    return view('reservation_calendar', compact('isAdmin'));
});


Route::get('/admin', function () {
    $isAdmin = true;
    return view('reservation_calendar', compact('isAdmin'));
});
