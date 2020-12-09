<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Tttp\Token;
use Validator;

class ProfileController extends Controller
{ 
    public function updateProfile(Request $request)
    {
        Validator::validate($request->all(),[
            'username' => 'string',
            'status' => 'string',
        ]);  
        
        if($request -> has('status')){
            $user = $request->user();
            $user->status= $request->input("status"); 
            $user->save();
        }

        if($request -> has('username') && $request->input("username") != null){
            $user = $request->user();
            $user->username = $request->input("username"); 
            $user->save();
        }


        return response()->json([
            'message' => 'Successfully updated user!'
        ], 201);
    }

}

