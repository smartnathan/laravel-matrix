<?php

use App\Http\Controllers\MatrixController;
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

Route::get('/', function () {
	return view('welcome');
});

Route::post('/matrix/multiplication', [MatrixController::class, 'matrix_multiplication']);
Route::post('/matrix/add', [MatrixController::class, 'add_matrix']);
Route::post('/matrix/clear', [MatrixController::class, 'clear_matrix']);

