<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listings = Listing::whereHas('user', function (Builder $query) {
            $query->where('role', '!=', 'suspended');
        })
            ->with('user')
            ->where('approved', true)
            ->filter(request(['search', 'user_id', 'tag']))
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return Inertia::render(
            'Home',
            [
                'listings' => $listings,
                'searchTerm' => $request->search,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $newTags = explode(',', $request->tags);
        // $newTags = array_map('trim', $newTags);
        // $newTags = filter($newTags);
        // $newTags = array_unique($newTags);
        // $newTags = implode(',', $newTags);
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'email' => ['nullable', 'email'],
            'description' => ['required', 'max:255'],
            'tags' => ['String', 'nullable'],
            'url' => ['url', 'nullable'],
            'image' => ['nullable', 'file', 'max:3072', 'mimes:png,jpg,jpeg,webp'],
        ]);

        if ($request->hasFile('image')) {
            $fields['image'] = Storage::disk('public')
                ->put('images/listing', $request->image);
        }

        $fields['tags'] = implode(
            ',',
            array_unique(
                array_filter(
                    array_map(
                        'trim',
                        explode(',', $request->tags)
                    )
                )
            )
        );

        $request->user()->listings()->create($fields);

        return redirect()->route('dashboard')->with('status', 'Listing created successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Listing/Create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return Inertia::render('Listing/Show', [
            'listing' => $listing,
            'user' => $listing->user->only(['id', 'name', 'email']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return Inertia::render('Listing/Edit', [
            'listing' => $listing,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'email' => ['nullable', 'email'],
            'description' => ['required', 'max:255'],
            'tags' => ['String', 'nullable'],
            'url' => ['url', 'nullable'],
            'image' => ['nullable', 'file', 'max:3072', 'mimes:png,jpg,jpeg,webp'],
        ]);

        if ($request->hasFile('image')) {

            if ($listing->image) {
                Storage::disk('public')->delete($listing->image);
            }
            $fields['image'] = Storage::disk('public')
                ->put('images/listing', $request->image);
        } else {
            $fields['image'] = $listing->image;
        }

        $fields['tags'] = implode(
            ',',
            array_unique(
                array_filter(
                    array_map(
                        'trim',
                        explode(',', $request->tags)
                    )
                )
            )
        );

        $listing->update($fields);
        return redirect()->route('dashboard')->with('status', 'Listing updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
