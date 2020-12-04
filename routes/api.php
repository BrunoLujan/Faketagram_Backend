<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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


Route::post('/signup', [LoginController::class,'signUp']);
Route::post('/login',[LoginController::class,'login']);

Route::group(['middleware' => 'auth:api'],function(){
Route::get('/user',[LoginController::class,'user']);
Route::get('/logout',[LoginController::class,'logout']);
});



