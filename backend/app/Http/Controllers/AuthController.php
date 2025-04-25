<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccessfulMail;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'contact' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'password' => Hash::make($request->password),
            ]);
    
            // Send registration email
            Mail::to($user->email)->send(new RegistrationSuccessfulMail($user));
    
            return response()->json(['message' => 'User registered successfully'], 201);
        } catch (Exception $e) {
            // Log the error details
            Log::error('Registration Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            // Return a generic error response
            return response()->json([
                'error' => 'An error occurred during registration.',
                'details' => $e->getMessage(), // Optional: Include this for debugging
            ], 500);
        }
    }

    public function login(Request $request) {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        $credentials = $request->only('email', 'password');

        // Check if the credentials are valid
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            // Debugging: Check if the user exists
            $userExists = User::where('email', $request->email)->exists();
            if (!$userExists) {
                return response()->json(['error' => 'User not found'], 404);
            }

            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
    

    public function logout(Request $request)
    {
        // For Sanctum token-based logout
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }


}


