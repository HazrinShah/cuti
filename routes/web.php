<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CutiController;


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
    return view('app');
});

Route::get('/cutis', [CutiController::class, 'index']);
Route::get('/cutis/tambah', [CutiController::class, 'tambah']);
Route::post('/cutis', [CutiController::class, 'store']);
Route::post('/cutis/{cuti}/update', [CutiController::class, 'update']);
Route::delete('/cutis/{cuti}', [CutiController::class, 'destroy']);