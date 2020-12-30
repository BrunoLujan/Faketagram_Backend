<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Photograph;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Tttp\Token;

class FeedController extends Controller
{ 
    public function addToFavourites(Request $request, int $photograph_id){
        
        $user = $request->user();
        $user_id = $user->user_id;

        if(DB::table("users_photographs_favourites")->where("user_id", $user_id)->where("photograph_id", $photograph_id)->count() == 0){
            DB::table("users_photographs_favourites")->insert(["user_id"=>$user_id,
            "photograph_id"=>$photograph_id]);

            return response()->json([
                'message' => 'Successfully added to favourites' 
            ]);
        }else{
            return response()->json([
                'message' => 'You already added this image to favorites' 
            ]);
        }
    }

    public function getFavourites(Request $request){
        $user = $request->user();

        return response()->json(
             $user->favourites()
        );           
    }

    public function addLikeToPhoto(Request $request, int $photograph_id){
        
        $user = $request->user();
        $user_id = $user->user_id;

        if(DB::table("users_photographs_likes")->where("user_id", $user_id)->where("photograph_id", $photograph_id)->count() == 0){
            DB::table("users_photographs_likes")->insert(["user_id"=>$user_id,
            "photograph_id"=>$photograph_id]);

            return response()->json([
                'message' => 'You like this photo' 
            ]);
        }else{
            return response()->json([
                'message' => 'You already like this photo' 
            ]);
        }
    }
}