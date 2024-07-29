<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SignupController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/signup',[SignupController::class,'signup']);
Route::post('/login',[LoginController::class,'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('logout',[LogoutController::class,'logout']);
});
