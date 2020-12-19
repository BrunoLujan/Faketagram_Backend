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
    public function getUserById(int $user_id){ //no lo estamos usando

        $user = User::find($user_id);

        return $user;
    }

    public function getUserByName(Request $request, string $name){
        $user =User::where("name", "LIKE", $name . "%")->get();
        
        return $user;
    }

    public function followUserById(Request $request, int $user_followed_id){
        

        if(isset($user_followed_id)){
            $user = $request->user();
            $user_follower_id = $user->user_id;
            DB::table("users_follower")->insert(["user_follower_id"=>$user_follower_id,
            "user_followed_id"=>$user_followed_id]);
        }

        return response()->json([
            'message' => 'Successfully followed user!' 
        ]);
        
    }
}