<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use HasApiTokens,HasFactory,Notifiable;
    
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    protected $fillable = ['name','lastname','username','email','password'];

    public function follows()
    {
        return DB::table("users_follower")->where("user_follower_id", $this->user_id)->get();
    }

    public function followers()
    {
        return DB::table("users_follower")->where("user_followed_id", $this->user_id)->get();
    }

    public function favourites()
    {
        return DB::table("users_photographs_favourites")->where("user_id", $this->user_id)->get();
    }
}
