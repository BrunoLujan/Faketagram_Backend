<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
}