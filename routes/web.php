<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JuegoController;

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

Route::get('/', HomeController::class);

Route::controller(JuegoController::class)->group(function() {
    Route::get('juego1', 'juego1');
    Route::get('juego2', 'juego2');
    Route::get('juego3', 'juego3');
    Route::get('juego4', 'juego4');
});


