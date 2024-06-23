<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::get('/students/{id?}',[StudentController::class,'index']);
Route::post('/student',[StudentController::class,'store']);
Route::get('student/{id}', [StudentController::class,'showbyid']);
Route::put('studentupdate',[StudentController::class,'update']);
Route::delete('studentdelete/{id}', [StudentController::class,'delete']);	