<?php
# using Sanctum
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiPassportController extends Controller
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

        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // User check by Email
        $user = User::where("email", $request->email)->first();

        if(!empty($user)){

            // Password check
            if(Hash::check($request->password, $user->password)){

                $token = $user->createToken("myToken")->accessToken;

                return response()->json([
                    "status" => true,
                    "message" => "Logged in successfully",
                    "token" => $token
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Password didn't match"
                ]);
            }
        } else {
            return response()->json([
                "status" => false,
                "message" => "Email is invalid"
            ]);
        }
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
        auth()->user()->token()->revoke();
        $user = auth()->user();
        $token = $user->createToken('MyToken')->accessToken;

        return response()->json([
            "status" => true,
            "message" => "Token re-issued",
            "token" => $token
        ]);
    }

    // Logout API
    public function logout(){

        auth()->user()->tokens()->delete();

        return response()->json([
            "status" => true,
            "message" => "User logged out"
        ]);
    }
}
