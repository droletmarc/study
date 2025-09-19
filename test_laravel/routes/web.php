<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

// All Listings
Route::get('/', [ListingController::class, 'index']);

#-------------------
# Listings
Route::prefix('listings')->controller(ListingController::class)
  ->group(function () {
    // All Listings
    Route::get('/', 'index');
    // display create listing form
    Route::get('create', 'create')->middleware('auth');
    // Create listing action
    Route::post('', 'store')->middleware('auth');
    // display edit listing form
    Route::get('edit/{listing}', 'edit')->middleware('auth');
    // Update listing action
    Route::put('update/{listing}', 'update')->middleware('auth');
    // Delete listing action
    Route::delete('destroy', 'destroy')->middleware('auth');
    // display manage listings
    Route::get('manage', 'manage')->middleware('auth');
    // display listing detail
    Route::get('{listing}', 'show');
  });

#-----------------
# Users
// Show register creation form
Route::get('/register', [UserController::class, 'create'])
  ->middleware('guest');

// create User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])
  ->middleware('auth');

// User Login
Route::get('/login', [UserController::class, 'login'])
  ->name('login')
  ->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);



// // Show create form
// Route::get('/listings/create', [ListingController::class, 'create'])
//   ->middleware('auth');

// // Store listing data
// Route::post('/listings', [ListingController::class, 'store']);

// // Edit listing data
// Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
//   ->middleware('auth');

// // Update the Listing
// Route::put('/listings/{listing}', [ListingController::class, 'update'])
//   ->middleware('auth');

// // Delete Listing
// Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])
//   ->middleware('auth');

// // Manage Listings
// Route::get('/listings/manage', [ListingController::class, 'manage'])
//   ->middleware('auth');

// // Single Listing
// Route::get('/listings/{listing}', [ListingController::class, 'show']);



// Route::get('/', function () {
//     return view('listings', [
//         'heading' => 'Latest Listings',
//         'listings' => Listing::all()
//     ]);
// });

// Single Listing
// Route::get('/listings/{id}', function ($id) {
//     $listing = Listing::find($id);
//     if ($listing) {
//         return view('listing', [
//             'listing' => $listing
//         ]);
//     } else {
//         abort('404');
//     }
// });
// Route::get('/listings/{listing}', function (Listing $listing) {
//     return view('listing', [
//         'listing' => $listing
//     ]);
// });

// Route::get('/hello', function () {
//     #return response('<h1>Heelo World</h1>');
//     return response('Heelo World', 200)
//         ->header('Content-Type', 'text/plain')
//         ->header('foo', 'bar');
//     #return 'Heelo World';
// });

// Route::get('/post/{id}', function ($id): Response {
//     // dd($id);
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');

// Route::get('/search', function (Request $request): Response {
//     dd($request->name . ' ' . $request->city);
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');
