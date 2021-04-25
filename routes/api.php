<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TodosController;
use \App\Http\Controllers\AuthController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
Route::post('logout',[AuthController::class,'logout']);

Route::get('/todos',[TodosController::class,'index']);
Route::post('/todos',[TodosController::class,'store']);
Route::put('/todos/{todo}',[TodosController::class,'update']);
Route::put('/todosCheckAll',[TodosController::class,'updateAll']);
Route::delete('/todos/{todo}',[TodosController::class,'destroy']);