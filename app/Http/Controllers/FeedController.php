<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Photograph;
use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Tttp\Token;

class FeedController extends Controller
{ 
    public function addToFavourites(Request $request, int $photograph_id)
    {
        
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

    public function getFavourites(Request $request)
    {
        $user = $request->user();

        return response()->json(
             $user->favourites()
        );           
    }

    public function getPhotographById(Request $request, int $photograph_id)
    {
        $photograph = Photograph::find($photograph_id);

        return $photograph;          
    }


    public function deleteFromFavourites(Request $request, int $photograph_id)
    {
        $user = $request->user();
        $user_id = $user->user_id;

        DB::table("users_photographs_favourites")->where("user_id", $user_id)->where("photograph_id", $photograph_id)->delete();

            return response()->json([
                'message' => 'Successfully deleted from favourites' 
            ]);
        
    }

    public function addLikeToPhoto(Request $request, int $photograph_id)
    {
        
        $user = $request->user();
        $user_id = $user->user_id;

        if(DB::table("users_photographs_likes")->where("user_id", $user_id)->where("photograph_id", $photograph_id)->count() == 0){
            DB::table("users_photographs_likes")->insert(["user_id"=>$user_id,
            "photograph_id"=>$photograph_id]);

            return response()->json([
                'message' => 'Now you like this photograph' 
            ]);
        }else{
            return response()->json([
                'message' => 'You already like this photo' 
            ]);
        }
    }

    public function deleteLikeFromPhoto(Request $request, int $photograph_id)
    {
        $user = $request->user();
        $user_id = $user->user_id;

        DB::table("users_photographs_likes")->where("user_id", $user_id)->where("photograph_id", $photograph_id)->delete();

            return response()->json([
                'message' => 'Successfully deleted from favourites' 
            ]);
        
    }

    public function getLikesByUserId(Request $request, int $user_id)
    {
        return response()->json(
            DB::table("users_photographs_likes")->where("user_id", $user_id)->get()
        );         
    }

    public function getLikesByPhotographId(Request $request, int $photograph_id)
    {
        return response()->json(
            DB::table("users_photographs_likes")->where("photograph_id", $photograph_id)->count()
        );         
    }

    public function addCommentToPhotograph(Request $request, int $photograph_id)
    {
        $request->validate([
            'comment'=> 'required|string'
        ]);
        
        $comment = new Comment();
        $comment->comment = $request->input("comment");
        $comment->publish_date = date("Y-m-d h:i:s", time());
        $comment->user_id = $request->user()->user_id;
        $comment->photograph_id = $photograph_id;

        if (!$comment->save()) {
            return response()->json([
                'message' => 'Try again!' 
            ]);
        }
        return response()->json([
            'message' => 'Successfully comment added to photo!' 
        ], 201);

    }

    public function getPhotographComments(Request $request, int $photograph_id){
        
        $comment = Comment::orderBy("publish_date","DESC")->where("photograph_id", $photograph_id)->get();
        return response()->json(
            $comment
        );                 
    }
}