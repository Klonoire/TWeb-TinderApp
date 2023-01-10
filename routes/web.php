<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PerroController;
use \App\Http\Controllers\InteraccionController;

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

Route::resource('perro', PerroController::class);
Route::resource('interaccion', InteraccionController::class);
Route::get('api/perros/candidato', [PerroController::class, 'candidato']);