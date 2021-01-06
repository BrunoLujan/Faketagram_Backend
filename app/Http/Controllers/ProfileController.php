<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Photograph;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Token;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;

class ProfileController extends Controller
{ 
    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|string'
        ]);  
        
        $user = $request->user();
        $user->status= $request->input("status"); 
        $user->save();

        return response()->json([
            'message' => 'Successfully updated status!' 
        ], 201);
    }

    public function uploadProfilePhoto(Request $request)
    {
        $request->validate([
            "image_storage_path" => "required|image|max:2048"
        ]);
        
        if ($request->hasFile("image_storage_path")) {
            $user = $request->user();
            if ($user->image_storage_path != null) {
                $old_photo_path =  $user->image_storage_path;
                Storage::disk("photos")->delete($old_photo_path);
            }

           
            $user->image_storage_path = $request->file("image_storage_path")->store(
                "", "photos"
            );
        }

        if(!$user->save()){
            return response()->json([
                'message' => 'Try again!' 
            ]);
        }
        return response()->json([
            'message' => 'Successfully uploaded photo!' 
        ], 201);
    }


    public function uploadFeedPhoto(Request $request) {
        
        $request->validate([
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

    public function getPhotographsByUserId(Request $request, int $user_id){

        return response()->json(
            DB::table("photographs")->where("user_id", $user_id)->get()
        );           
    }

    public function getFeedPhotographs(Request $request){
        $photograph = Photograph::whereIn("user_id", DB::table("users_follower")->selectRaw("user_followed_id AS user_id")->where("user_follower_id",
        $request->user()->user_id))->orderBy("publish_date","DESC")->get();

        return response()->json(
            $photograph
        );          
    }

}

