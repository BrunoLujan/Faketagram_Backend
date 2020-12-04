<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Carbon\Carbon;


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
            'password' => 'required|string'

        ]);

        $user = new User();
        $user->name = $request->input("name");
        $user->lastname = $request->input("lastname");
        $user->username = $request->input("username");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));
        $user->save();


        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where("email", $request->input("email"))->get()->first();
        if ($user == null) {
            return response()->json([
                'message' => 'UnauthorizedEmail'
            ], 401);
        }
        if (!Hash::check($request->input("password"), $user->password)) {
            return response()->json([
                'message' => 'UnauthorizedPassword'
            ], 401);
        }
        
        $tokenResult = $user->createToken('Auth Token')->accessToken;

        return response()->json([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer'
        ]);
    }
}

