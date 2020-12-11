<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
//});

//Route::post("/login", [LoginController::class, "authenticate"]);


Route::post('/user/sign_up', [LoginController::class,'signUp']);
Route::post('/user/login',[LoginController::class,'login']);

Route::group(['middleware' => 'auth:api'],function(){
Route::get('/user/logout',[LoginController::class,'logout']);
Route::get('/user/user',[LoginController::class,'user']);
Route::post('/user//update_profile', [ProfileController::class,'updateProfile']);
Route::get('/user/{user_id}/get_user',[HomeController::class,'getUserById']);
Route::get('/user/{name}/get_name',[HomeController::class,'getUserByName']);
});





