<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use HasApiTokens,HasFactory,Notifiable;

    protected $primaryKey = 'user_id';
    public $timestamps = false;
    protected $fillable = ['name','lastname','username','email','password','status',
    'cellphone', 'image_storage_path'];
    
}
