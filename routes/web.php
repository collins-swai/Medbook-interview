<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('patients', 'App\Http\Controllers\PatientController');
Route::resource('genders', 'App\Http\Controllers\GenderController');
Route::resource('services', 'App\Http\Controllers\ServiceController');

