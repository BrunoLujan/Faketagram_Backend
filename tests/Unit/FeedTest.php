<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class FeedTest extends TestCase
{
    /**
     * Test to add to favourites an already added image
     * 
     * @test
     * 
     * @return void
     */
    public function add_to_favourites_an_already_added_image_test()
    {   
        $user = User::find(4);
        $response = $this->actingAs($user,"api")->postJson("/api/user/1/addToFavourites", [
        ]);

        $response->assertJson([
            "message" => "You already added this image to favorites"
        ]);
    }

    /**
     * Attempts to test get a photograph with a non-existent photograph id
     * 
     * @test
     * 
     * @return void
     */
    public function get_photograph_with_non_existent_photograpg_id_test()
    {   
        $user = User::find(1);
        $response = $this->actingAs($user,"api")->getJson("/api/user/11/getPhotographById", [

        ]);
        $response->assertJson([
            "message" => "The photograph doesn´t exit"
        ]);
    }

    /**
     * Test to add a like to a photograph with
     * a like already added
     * 
     * @test
     * 
     * @return void
     */
    public function add_like_to_photograph_with_a_like_already_added_test()
    {   
        $user = User::find(4);
        $response = $this->actingAs($user,"api")->postJson("/api/user/1/addLikeToPhoto", [
        ]);

        $response->assertJson([
            "message" => "You already like this photo"
        ]);
    }

    /**
     * Attempts to test get user's photograph likes with a non-existent
     * user id
     * 
     * @test
     * 
     * @return void
     */
    public function get_user_photograph_likes_with_a_non_existent_user_id_test()
    {   
        $user = User::find(1);
        $response = $this->actingAs($user,"api")->getJson("/api/user/5/getLikesByUserId", [

        ]);
        $response->assertJson([
            "message" => "The user doesn´t exit"
        ]);
    }

    /**
     * Attempts to test get photograph's likes with a non-existent
     * photograph id
     * 
     * @test
     * 
     * @return void
     */
    public function get_photograph_likes_with_a_non_existent_photograph_id_test()
    {   
        $user = User::find(1);
        $response = $this->actingAs($user,"api")->getJson("/api/user/5/getLikesByPhotographId", [

        ]);
        $response->assertJson([
            "message" => "The photograph doesn´t exit"
        ]);
    }

    /**
     * Attempts to test add a comment to a photograph with
     * invalid data
     * 
     * 
     * @test
     * 
     * @return void
     */
    public function add_comment_to_photograph_with_invalid_data_test(){
        $user = User::find(1);
        $response = $this->actingAs($user,"api")->postJson("/api/user/1/addCommentToPhotograph", [
            "comment" => 23
        ]);
        
        $response->assertJson([
            "message" => "The given data was invalid."
        ]);
    }

    /**
     * Attempts to test get photograph's comments with a non-existent
     * photograph id
     * 
     * @test
     * 
     * @return void
     */
    public function get_photograph_comments_with_a_non_existent_photograph_id_test()
    {   
        $user = User::find(1);
        $response = $this->actingAs($user,"api")->getJson("/api/user/12/getPhotographComments", [

        ]);
        $response->assertJson([
            "message" => "The photograph doesn´t exit"
        ]);
    }
    
}