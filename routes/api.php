<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FeedController;

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


Route::post('/user/signUp', [LoginController::class,'signUp']);
Route::post('/user/login',[LoginController::class,'login']);

Route::group(['middleware' => 'auth:api'],function(){
    //LOGIN CONTROLLER
Route::get('/user/logout',[LoginController::class,'logout']);
Route::get('/user/user',[LoginController::class,'user']);
    //PROFILE CONTROLLER
Route::post('/user/updateStatus', [ProfileController::class,'updateStatus']);
Route::post('/user/uploadProfilePhoto', [ProfileController::class,'uploadProfilePhoto']);
Route::post('/user/uploadFeedPhoto', [ProfileController::class,'uploadFeedPhoto']);
Route::get('/user/{user_id}/getUserPhotographs',[ProfileController::class,'getPhotographsByUserId']);
Route::get('/user/getFeedPhotographs',[ProfileController::class,'getFeedPhotographs']);
    //HOME CONTROLLER
Route::get('/user/{user_id}/getUser',[HomeController::class,'getUserById']);
Route::get('/user/{name}/getName',[HomeController::class,'getUserByName']);
Route::post('/user/{user_followed_id}/followUser',[HomeController::class,'followUserById']);
Route::delete('/user/{user_followed_id}/unfollowUser',[HomeController::class,'unfollowUserById']);
Route::get('/user/following',[HomeController::class,'getFollows']);
Route::get('/user/followers',[HomeController::class,'getFollowers']);
    //FEED CONTROLLER
Route::post('/user/{photograph_id}/addToFavourites',[FeedController::class,'addToFavourites']);
Route::delete('/user/{photograph_id}/deleteFromFavourites',[FeedController::class,'deleteFromFavourites']);
Route::get('/user/favourites',[FeedController::class,'getFavourites']);
Route::post('/user/{photograph_id}/addLikeToPhoto',[FeedController::class,'addLikeToPhoto']);
Route::get('/user/{user_id}/getLikesByUserId',[FeedController::class,'getLikesByUserId']);
Route::get('/user/{photograph_id}/getLikesByPhotographId',[FeedController::class,'getLikesByPhotographId']);
Route::delete('/user/{photograph_id}/deleteLikeFromPhoto',[FeedController::class,'deleteLikeFromPhoto']);
Route::post('/user/{photograph_id}/addCommentToPhotograph',[FeedController::class,'addCommentToPhotograph']);
Route::get('/user/{photograph_id}/getPhotographComments',[FeedController::class,'getPhotographComments']);

});





