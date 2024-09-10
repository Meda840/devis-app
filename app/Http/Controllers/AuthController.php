<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Create the user
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        if($user) {
            $token = $user->createToken('Personal Access Token')->plainTextToken;
        }

        // Return success response
        return response()->json([
            'message' => 'User registered successfully',
            'token' => $token,
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
            $user = Auth::user();
            $existingToken = $user->tokens()->first(); // Check if user already has a token

            if ($existingToken) {
                $token = $existingToken->token;
            } else {
                $token = $user->createToken('Personal Access Token')->plainTextToken;
            }

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }


    public function getUserInfo(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'User information updated successfully',
            'user' => $user
        ]);
    }

}