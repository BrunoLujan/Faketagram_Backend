<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class ProfileTest extends TestCase
{
    /**
     * Attempts to test update status with invalid data.
     * 
     * @test
     * 
     * @return void
     */
    public function update_status_with_invalid_data_test()
    {   
        $user = User::find(1);
        $response = $this->actingAs($user,"api")->postJson("/api/user/updateStatus", [
            "status" => 23
        ]);
        $response->assertJsonStructure([
            "message",
            "errors"
        ]);
    }

    /**
     * Attempts to test upload profile photo with invalid data.
     * 
     * @test
     * 
     * @return void
     */
    public function upload_profile_photo_with_invalid_data_test()
    {   
        $user = User::find(1);
        $response = $this->actingAs($user,"api")->postJson("/api/user/uploadProfilePhoto", [
            "image_storage_path" => 23
        ]);
        $response->assertJson([
            "message" => "The given data was invalid."   
        ]);
    }

    /**
     * Attempts to test upload feed photo with invalid data.
     * 
     * @test
     * 
     * @return void
     */
    public function upload_feed_photo_with_invalid_data_test()
    {   
        $user = User::find(1);
        $response = $this->actingAs($user,"api")->postJson("/api/user/uploadFeedPhoto", [
            "image_storage_path" => 23
        ]);
        $response->assertJson([
            "message" => "The given data was invalid."   
        ]);
    }

    /**
     * Attempts to test get user's photograph with a non-existent
     * user id
     * 
     * @test
     * 
     * @return void
     */
    public function get_photograph_with_non_existent_user_id_test()
    {   
        $user = User::find(1);
        $response = $this->actingAs($user,"api")->getJson("/api/user/5/getUserPhotographs", [

        ]);
        $response->assertJson([
            "message" => "The user doesn´t exit"
        ]);
    }
}