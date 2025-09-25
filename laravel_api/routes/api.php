<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ApiJwtController;
use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\ApiPassportController;

Route::apiResource('Listing', ListingController::class);

// for Sanctum auth
Route::post("register", [ApiController::class, "register"]);
Route::post("login", [ApiController::class, "login"]);
Route::group(["middleware" => ["auth:sanctum"] ], function(){
    Route::get("profile", [ApiController::class, "profile"]);
    Route::get("logout", [ApiController::class, "logout"]);
});


// for passport
// Route::post("register", [ApiPassportController::class, "register"]);
// Route::post("login", [ApiPassportController::class, "login"]);
// Route::group(["middleware" => ["auth:api"] ], function(){
//     Route::get("profile", [ApiPassportController::class, "profile"]);
//     Route::get("refresh", [ApiPassportController::class, "refreshToken"]);
//     Route::get("logout", [ApiPassportController::class, "logout"]);
// });

// For JWT
// Route::post("register", [ApiJwtController::class, "register"]);
// Route::post("login", [ApiJwtController::class, "login"]);
// Route::group(["middleware" => ["auth:api"] ], function(){
//     Route::get("profile", [ApiJwtController::class, "profile"]);
//     Route::get("refresh", [ApiJwtController::class, "refreshToken"]);
//     Route::get("logout", [ApiJwtController::class, "logout"]);
// });
