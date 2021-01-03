<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Tttp\Token;



class HomeController extends Controller
{ 
    public function getUserById(int $user_id){   

        $user = User::find($user_id);

        return $user;
    }

    public function getUserByName(Request $request, string $name){
        $user =User::where("name", "LIKE", $name . "%")->get();
        
        return $user;
    }

    public function followUserById(Request $request, int $user_followed_id){
        
        $user = $request->user();
        $user_follower_id = $user->user_id;

        if(DB::table("users_follower")->where("user_follower_id", $user_follower_id)->where("user_followed_id", $user_followed_id)->count() == 0){
            DB::table("users_follower")->insert(["user_follower_id"=>$user_follower_id,
            "user_followed_id"=>$user_followed_id]);
        }else{
            return response()->json([
                'message' => 'You already follow this user' 
            ]);
        }

        return response()->json([
            'message' => 'Successfully followed user!' 
        ]);   
    }

    public function unfollowUserById(Request $request, int $user_followed_id){
        
        $user = $request->user();
        $user_follower_id = $user->user_id;

        DB::table("users_follower")->where("user_follower_id", $user_follower_id)->where("user_followed_id", $user_followed_id)->delete();

        return response()->json([
            'message' => 'Successfully unfollowed user!' 
        ]);  
         
    }

    public function getFollows(Request $request){
        $user = $request->user();
        $name = $user->name;

        return response()->json(
             $user->follows()
        );           
    }

    public function getFollowers(Request $request){
        $user = $request->user();
        $name = $user->name;

        return response()->json(
             $user->followers()
        );           
    }

   
}