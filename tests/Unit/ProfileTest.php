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
}