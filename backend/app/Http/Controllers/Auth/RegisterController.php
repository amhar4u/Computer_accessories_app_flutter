<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Exception;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'contact' => 'required|string|max:15',
                'password' => 'required|string|min:6|confirmed',  // `confirmed` expects a `password_confirmation` field
            ]);

            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'password' => Hash::make($request->password),  // Hashing the password before storing
            ]);

            // Return success response with user details
            return response()->json([
                'message' => 'User registered successfully!',
                'user' => $user,
            ], 201);
        } catch (Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json([
                'error' => 'Registration failed!',
                'message' => $e->getMessage(),
            ], 500); // Internal Server Error
        }
    }
}
