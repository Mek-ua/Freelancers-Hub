<?php

namespace App\Http\Controllers;

use App\Models\Rate_number;
use Illuminate\Http\Request;

class RateNumberController extends Controller
{
    public function index()
    {
        // Retrieve all rate numbers
        return Rate_number::all();
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'rate_number' => 'required|string|max:10|unique:rate_numbers,rate_number',
        ]);

        // Create and return the new rate number
        return Rate_number::create($request->only(['rate_number']));
    }

    public function show(Rate_number $Rate_number)
    {
        // Return a specific rate number
        return $Rate_number;
    }

    public function update(Request $request, Rate_number $Rate_number)
    {
        // Validate the incoming request
        $request->validate([
            'rate_number' => 'required|string|max:10|unique:rate_numbers,rate_number,' . $Rate_number->id,
        ]);

        // Update and return the rate number
        $Rate_number->update($request->only(['rate_number']));
        return $Rate_number;
    }

    public function destroy(Rate_number $Rate_number)
    {
        // Delete the rate number
        $Rate_number->delete();
        return response()->json(['message' => 'Rate number deleted successfully.'], 204);
    }
}
