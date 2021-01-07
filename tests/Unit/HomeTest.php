<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class HomeTest extends TestCase
{
    /**
     * Attempts to test get user with a non-existent user id
     * 
     * @test
     * 
     * @return void
     */
    public function get_user_with_non_existent_user_id_test()
    {   
        $user = User::find(1);
        $response = $this->actingAs($user,"api")->getJson("/api/user/5/getUser", [

        ]);
        $response->assertJson([
            "message" => "The user doesn´t exit"
        ]);
    }

    /**
     * Attempts to test get user with a non-existent name
     * 
     * @test
     * 
     * @return void
     */
    public function get_user_with_non_existent_name_test()
    {   
        $user = User::find(1);
        $response = $this->actingAs($user,"api")->getJson("/api/user/karla/getName", [

        ]);
        $response->assertJson([
            "message" => "The user doesn´t exit"
        ]);
    }

    /**
     * Test to follow an already followed user
     * 
     * @test
     * 
     * @return void
     */
    public function follow_user_already_followed_test()
    {   
        $user = User::find(1);
        $response = $this->actingAs($user,"api")->postJson("/api/user/2/followUser", [
        ]);

        $response->assertJson([
            "message" => "You already follow this user"
        ]);
    }
    
}