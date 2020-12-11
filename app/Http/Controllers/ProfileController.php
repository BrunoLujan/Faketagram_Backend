<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Token;
use Illuminate\Support\Facades\Storage;
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

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            "image" => "required|image|max:2048"
        ]);
        
        if ($request->hasFile("image_storage_path")) {
            $user->image_storage_path = $request->file("image_storage_path")->store(
                "", "photos"
            );
        }
    }

}

