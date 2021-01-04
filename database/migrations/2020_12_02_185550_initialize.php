<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Initialize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create("users", function (Blueprint $table){
            $table->increments("user_id");
            $table->string("name",100);
            $table->string("lastname",100);
            $table->string("username",20);
            $table->string("email")->unique();
            $table->string("password");
            $table->string("status")->nullable();
            $table->string("cellphone")->nullable();
            $table->boolean("remember_me")->nullable();
            $table->string("image_storage_path")->nullable();
            
        });

        Schema::Create("users_follower", function (Blueprint $table){
            $table->integer("user_followed_id")->unsigned();
            $table->foreign("user_followed_id")->references("user_id")->on("users");
            $table->integer("user_follower_id")->unsigned();
            $table->foreign("user_follower_id")->references("user_id")->on("users");
            $table->primary(["user_followed_id","user_follower_id"]);
            
        });

        Schema::Create("photographs", function (Blueprint $table){
            $table->increments("photograph_id");
            $table->date("publish_date")->nullable();
            $table->string("image_storage_path");  
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("user_id")->on("users");  
        });

        Schema::Create("users_photographs_favourites", function (Blueprint $table){
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("user_id")->on("users");
            $table->integer("photograph_id")->unsigned();
            $table->foreign("photograph_id")->references("photograph_id")->on("photographs");
            $table->primary(["user_id","photograph_id"]);
            
        });

        Schema::Create("users_photographs_likes", function (Blueprint $table){
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("user_id")->on("users");
            $table->integer("photograph_id")->unsigned();
            $table->foreign("photograph_id")->references("photograph_id")->on("photographs");
            $table->primary(["user_id","photograph_id"]);
            
        });

        Schema::Create('comments', function (Blueprint $table){
            $table->integer("comment_id")->unsigned();
            $table->date('publish_date')->nullable();
            $table->string('comment');
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("user_id")->on("users");
            $table->integer("photograph_id")->unsigned();
            $table->foreign("photograph_id")->references("photograph_id")->on("photographs");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("comments");
        Schema::dropIfExists("users_photographs_likes");
        Schema::dropIfExists("users_photographs_favourites");
        Schema::dropIfExists("photographs");
        Schema::dropIfExists("users_follower");
        Schema::dropIfExists("users");
    }
}
