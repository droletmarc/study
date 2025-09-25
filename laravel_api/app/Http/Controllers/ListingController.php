<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Validation\Rule;
use App\Http\Requests\ListingCreateRequest;
use App\Jobs\ListingCreated;

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
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show the create form
    public function create() {
        return view('listings.create', []);
    }

    // Store listing data
    public function store(ListingCreateRequest $request) {
        // TODO: how to grab all fields of that objecct only?

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

        // or use the ->with()
        // Session::flash('message', 'my message');

        return redirect('/')
            ->with('message', 'Listing created successfully!');
    }

    // Edit Listing
    public function edit(Listing $listing) {
        return view('listings.edit', [
            'listing' => $listing
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

        return back()
            ->with('message', 'Listing updated successfully!');
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

        return redirect('/')
            ->with('message', 'Listing deleted successfully');
    }

    // Manage Listings
    public function manage() {
        return view('listings.manage', [
            'listings' => auth()->guard()->user()->listings()->get()
            //'listings' => Auth::user()->listings()->get()
        ]);
    }

    public function like($id, Request $request) {
        $response = \Http::get('http://test_laravel.local/user/random');
        return $response->json();
    }
}
