<?php

namespace Tests\Unit;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Attempts to test sign up with invalid data.
     * 
     * @test
     * 
     * @return void
     */
    public function signUp_with_invalid_data_test()
    {
        $response = $this->postJson("/api/user/signUp", [
            "name" => "NameTest",
            "lastname" => "123937",
            "username" => "928736",
            "email" => "91872",
            "password" => "1"
        ]);
        $response->assertJsonStructure([
            "message",
            "errors"
        ]);
    }

    /**
     * Attempts to test sign up with valid data.
     * 
     * @test
     * 
     * @return void
     */
    public function signUp_with_valid_data_test()
    {
        $response = $this->postJson("/api/user/signUp", [
            "name" => "NameTest",
            "lastname" => "LastnameTest",
            "username" => "UsernameTest",
            "email" => "emailTest@gmail.com",
            "password" => "passwordTest"
        ]);
        $response->assertJsonStructure([
            "message"    
        ]);
    }

    /**
     * Attempts to test log in with invalid data.
     * 
     * @test
     * 
     * @return void
     */
    public function login_with_invalid_data_test()
    {
        $response = $this->postJson("/api/user/login", [

            "email" => "9374",
            "password" => "139838",
            "remember_me" => "1"
        ]);
        $response->assertJsonStructure([
            "message",
            "errors"    
        ]);
    }

    /**
     * Attempts to test log in with a non-existent account.
     * 
     * @test
     * 
     * @return void
     */
    public function login_with_non_existent_account_test()
    {
        $response = $this->postJson("/api/user/login", [

            "email" => "test12@gmail.com",
            "password" => "passwordTest",
            "remember_me" => true
        ]);
        $response->assertJson([
            "message" => "Unauthorized Email"   
        ]);
    }

    /**
     * Attempts to test log in with an existent account but,
     * using a wrong password
     * 
     * @test
     * 
     * @return void
     */
    public function login_with_wrong_password_test()
    {
        $response = $this->postJson("/api/user/login", [

            "email" => "emailTest@gmail.com",
            "password" => "password",
            "remember_me" => true
        ]);
        $response->assertJson([
            "message" => "Unauthorized Password"  
        ]);
    }
}