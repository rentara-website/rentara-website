<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = Rating::with('product')->latest()->paginate(20);

        return view('admin.ratings.index', [
            'ratings' => $ratings,
            'title' => 'Ratings Management'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRatingRequest $request)
    {
        $validatedData = $request->validated();

        Rating::create($validatedData);

        return redirect()->back()->with('success', 'Rating berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        return view('admin.ratings.edit', [
            'rating' => $rating,
            'title' => 'Edit Rating',
            'products' => \App\Models\Product::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $validatedData = $request->validated();

        $rating->update($validatedData);

        return redirect()->route('admin.ratings.index')->with('success', 'Rating berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();

        return redirect()->route('admin.ratings.index')->with('success', 'Rating berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $q = $request->get('q');

        $ratings = Rating::query()
            ->when($q, function ($query) use ($q) {
                $query->where('nama', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('komentar', 'like', "%{$q}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.ratings.partials.rows', compact('ratings'));
    }
}