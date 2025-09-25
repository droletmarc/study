<?php
# using Sanctum
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiJwtController extends Controller
{
    // Register API - name, email, password, password_confirmation
    public function register(Request $request){

        $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed",
        ]);

        User::create($request->all());

        return response()->json([
            "status" => true,
            "message" => "User registered successfully"
        ]);
    }

    // Login API
    public function login(Request $request){

        $data = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $token = auth()->attempt($data);
        if ($token) {
            return response()->json([
                "status" => true,
                "message" => "Logged in successfully",
                "token" => $token
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "Invalid credentials"
        ]);
    }

    // Profile API
    public function profile(){

        $userdata = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userdata,
            "id" => auth()->user()->id
        ]);
    }

    public function refreshToken() {
        $token = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "Token re-issued",
            "token" => $token
        ]);
    }

    // Logout API
    public function logout(){

        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "User logged out"
        ]);
    }
}
