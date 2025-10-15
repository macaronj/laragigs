<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index(): View
    {
        return view("listings.index", [
            "listings" => Listing::latest()
                ->filter(request(["tag", "search"]))
                ->paginate(8),
        ]);
    }

    // Show single listing
    public function show(Listing $listing): View
    {
        return view("listings.show", [
            "listing" => $listing,
        ]);
    }

    // Show create Form
    public function create()
    {
        return view("listings.create");
    }

    // Store listing data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "title" => "required",
            "company" => ["required", Rule::unique("listings", "company")],
            "location" => "required",
            "website" => ["required", "url"],
            "email" => ["required", "email"],
            "tags" => "required",
            "description" => "required",
            "logo" => "image",
        ]);

        if ($request->hasFile("logo")) {
            $formFields["logo"] = $request
                ->file("logo")
                ->store("logo", "public");
        }

        $formFields["user_id"] = auth()->id();

        Listing::create($formFields);

        return redirect("/")->with("status", "Listing was created!");
    }

    // Edit single listing
    public function edit(Listing $listing): View
    {
        // Check if user is authorized to edit
        if ($listing->user_id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }

        return view("listings.edit", [
            "listing" => $listing,
        ]);
    }

    // Store listing data
    public function update(Request $request, Listing $listing)
    {
        // Check if user is authorized to edit
        if ($listing->user_id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }

        $formFields = $request->validate([
            "title" => "required",
            "company" => "required",
            "location" => "required",
            "website" => ["required", "url"],
            "email" => ["required", "email"],
            "tags" => "required",
            "description" => "required",
            "logo" => "image",
        ]);

        if ($request->hasFile("logo")) {
            $formFields["logo"] = $request
                ->file("logo")
                ->store("logo", "public");
        }

        $listing->update($formFields);

        return back()->with("status", "Listing was updated!");
    }

    // Delete listing
    public function destroy(Listing $listing)
    {
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }

        $listing->delete();

        return redirect("/")->with("status", "Listing deleted!");
    }

    // Manage listings
    public function manage(): View
    {
        $listings = auth()->user()->listings()->get();

        return view("listings.manage", ["listings" => $listings]);
    }
}
