<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
  
    //public function authenticate(Request $request)
    //{
        //$credentials = $request->only('email', 'password');

        //if (Auth::attempt($credentials)) {
            //$data['status'] = 'ok';  
        //}else{
            //$data['status'] = 'error';
        //}
        //return response()->json($data);
    //}

    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'status' => 'required|string',
            'cellphone' => 'required|string',
            'image_storage_path' => 'required|string'

        ]);

        $user = new User();
        $user->name = $request->input("name");
        $user->lastname = $request->input("lastname");
        $user->username = $request->input("username");
        $user->email = $request->input("email");
        $user->password = $request->input("password");
        $user->status = $request->input("status");
        $user->cellphone = $request->input("cellphone");
        $user->image_storage_path= $request->input("image_storage_path");
        $user->save();


        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
}
