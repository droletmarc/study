<?php

namespace App\Http\Controllers\Api;

use Http;
use App\Models\Listing;
use App\Jobs\ListingCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Validation\Rule;
use App\Http\Requests\ListingCreateRequest;

class ListingController extends Controller
{
    // All Listing
    // public function index(Request $request) { # dependency injections
    // request() with the helper
    public function index() {
        return response()->json(Listing::all());
    }

    // Show single listing
    public function show(Listing $listing){
        return response()->json([
            'status' => true,
            'message' => 'Listing Found',
            'data' => $listing
        ]);
    }

    // Store listing data
    public function store(ListingCreateRequest $request) {
        // TODO: how to grab all fields of that object only?

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'], //, Rule::unique('listings', 'company')],
            'location' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
            'website' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // to add the user logged relationship to the listing object
        $formFields['user_id'] = auth()->guard()->id();

        $listing = Listing::create($formFields);

        // To send the created event to the queue
        // Not sure we can use $_ENV here
        // ListingCreated::dispatch($listing->toArray())->onQueue($_ENV('RABBITMQ_QUEUE'));

        return response()->json([
            'status' => true,
            'message' => 'Listing created successfully',
            'data' => $listing
        ]);
    }

    // Update Listing
    public function update(ListingCreateRequest $request, Listing $listing) {

        // Make sure logged in user is owner
        if ($listing->user_id != auth()->guard()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'], //, Rule::unique('listings', 'company')],
            'location' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
            'website' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return response()->json($listing);
    }

    // Delete Listing
    public function destroy(Listing $listing) {
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->guard()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();

        if ($listing->logo &&
            Storage::disk('public')->exists($listing->logo)
        ) {
            Storage::disk('public')->delete($listing->logo);
        }

        return response()->json([
            'success' => true,
            'message' => 'Listing deleted successfully'
        ]);
    }

}
