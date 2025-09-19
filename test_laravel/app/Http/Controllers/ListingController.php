<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
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
        // Listing::all(); # return all asc order I guess
        // Listing::latest()->get(); all orderred desc
        return view('listings.index', [
            'listings' => Listing::latest()
                ->filter(request(['tag', 'search']))
                ->paginate(6) # pagination with numbers
                //->simplePaginate(2) # next/previous button only
        ]);
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

        Listing::create($formFields);
        // $listing = new Listing();
        // $listing->user_id = auth()->guard()->id();
        // $listing->title = $request->title;
        // $listing->company = $request->company;
        // $listing->location = $request->location;
        // $listing->email = $request->email;
        // $listing->website = $request->website;
        // $listing->tags = $request->tags;
        // $listing->description = $request->description;
        // $listing->save();

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
}
