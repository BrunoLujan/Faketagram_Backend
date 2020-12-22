<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Photograph;

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

    public function uploadProfilePhoto(Request $request)
    {
        $request->validate([
            "image_storage_path" => "required|image|max:2048"
        ]);
        
        if ($request->hasFile("image_storage_path")) {
            $user = $request->user();
            $user->image_storage_path = $request->file("image_storage_path")->store(
                "", "photos"
            );
        }
        $user->save();

        if(!$user->save()){
            return response()->json([
                'message' => 'Try again!' 
            ]);
        }
        return response()->json([
            'message' => 'Successfully uploaded photo!' 
        ], 201);
    }

    public function uploadPhotosFeed(Request $request) {
        
        $request->validate([
            'publish_date' => 'required|date',
            'image_storage_path'=> 'required|image|max:2048'
        ]);

        $photograph = new Photograph();
        $photograph->publish_date = date("Y-m-d h:i:s", time());
        $photograph->image_storage_path = $request->file("image_storage_path")->store( "", "photos");
        $photograph->user_id = $request->user()->user_id;
        if (!$photograph->save()) {
            return response()->json([
                'message' => 'Try again!' 
            ]);
        }
        return response()->json([
            'message' => 'Successfully uploaded photo!' 
        ], 201);
    }

}

