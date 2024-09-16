<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Illuminate\Routing\Events\ResponsePrepared;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string',
            'phonenumber' => 'required|string',
            'memberSince' => 'string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'phonenumber' => $request->phonenumber,
            'memberSince' => $request->memberSince,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('authtoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
         $request->validate([
            'email' => ['required', 'string', 'email', 'exists:users'],
            'password' => ['required'],
        ]);

        $user = User::where('email', request('email'))->first();

        // Check if user exists

        if(!is_object($user)) {
            return response()->json([
                'success' => false,
                'message' => 'Wrong Login Credentials'
            ]);

         // Checking if user is verified 

        if(!$user->isVerified()) {
            return response()->json([
                'success' => false,
                'message' => 'Account not active. Kindly check your email for activation code.'
            ]);
        }
        }

        // Trying to authenticate user with provided details

        if(Auth::attempt(request(['email', 'password']))) {
            $user = Auth::user();
            $request->session()->regenerate(); //preventing session fixation

        }
        if(!$user || !Hash::check(request('password'), $user->password)) {
            return response([
                'message' => 'Wrong Credentials'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        $request->session()->invalidate();

        return [
            'message' => 'Logged out',
        ];
    }
}
