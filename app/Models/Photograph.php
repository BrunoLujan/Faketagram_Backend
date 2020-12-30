<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Photograph extends Model
{
    use HasFactory;

    protected $primaryKey = 'photograph_id';
    public $timestamps = false;
    protected $fillable = ['publish_date','image_storage_path'];

   
}
