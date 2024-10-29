<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        // Retrieve all ratings
        return Rating::all();
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'taker_id' => 'required|exists:users,id',
            'giver_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required|integer',
            'comment' => 'nullable|string',
        ]);

        // Create and return the new Ratings
        return Rating::create($request->only(['taker_id', 'giver_id', 'project_id', 'amount', 'comment']));
    }

    public function show(Rating $Ratings)
    {
        // Return a specific Ratings
        return $Ratings;
    }

    public function update(Request $request, Rating $Ratings)
    {
        // Validate the incoming request
        $request->validate([
            'taker_id' => 'required|exists:users,id',
            'giver_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required|integer',
            'comment' => 'nullable|string',
        ]);

        // Update and return the Ratings
        $Ratings->update($request->only(['taker_id', 'giver_id', 'project_id', 'amount', 'comment']));
        return $Ratings;
    }

    public function destroy(Rating $Ratings)
    {
        // Delete the Ratings
        $Ratings->delete();
        return response()->json(['message' => 'Ratings deleted successfully.'], 204);
    }
}
