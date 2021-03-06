<?php

use App\Http\Controllers\Api\AuthController;
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

Route::prefix('v1')->group(function(){
	Route::post('/auth/register', [AuthController::class, 'register']);
	Route::post('/auth/login', [AuthController::class, 'login']);
	Route::post('/auth/logout', [AuthController::class, 'logout']);
});
