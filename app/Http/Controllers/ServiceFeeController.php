<?php

namespace App\Http\Controllers;

use App\Models\ServiceFee;
use Illuminate\Http\Request;

class ServiceFeeController extends Controller
{
    public function index()
    {
        // Get all service fees
        return ServiceFee::all();
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'percent' => 'required|numeric|min:0|max:100',
            'state' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
        ]);

        // Create a new service fee
        return ServiceFee::create($request->only(['percent', 'state', 'user_id']));
    }

    public function show(ServiceFee $Service_fees)
    {
        // Return the specified service fee
        return $Service_fees;
    }

    public function update(Request $request, ServiceFee $Service_fees)
    {
        // Validate the request
        $request->validate([
            'percent' => 'required|numeric|min:0|max:100',
            'state' => 'required|boolean',
        ]);

        // Update the service fee
        $Service_fees->update($request->only(['percent', 'state']));
        return $Service_fees;
    }

    public function destroy(ServiceFee $Service_fees)
    {
        // Delete the service fee
        $Service_fees->delete();
        return response()->json(['message' => 'Service fee deleted successfully.'], 204);
    }
}
