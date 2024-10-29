<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function index()
    {
        // Get all freelancers
        return Freelancer::all();
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'certificate' => 'nullable|json',
            'graduation_year' => 'nullable|integer',
            'portfolio' => 'nullable|json',
            'educational_files' => 'nullable|string',
            'experiance' => 'required|integer|min:0',
            'college' => 'nullable|string|max:255',
            'educational_status_id' => 'required|exists:educational_statuses,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Create a new freelancer
        return Freelancer::create($request->only([
            'certificate',
            'graduation_year',
            'portfolio',
            'educational_files',
            'experiance',
            'college',
            'educational_status_id',
            'user_id'
        ]));
    }

    public function show(Freelancer $freelancer)
    {
        // Return a specific freelancer
        return $freelancer;
    }

    public function update(Request $request, Freelancer $freelancer)
    {
        // Validate the request
        $request->validate([
            'certificate' => 'nullable|json',
            'graduation_year' => 'nullable|integer',
            'portfolio' => 'nullable|json',
            'educational_files' => 'nullable|string',
            'experiance' => 'required|integer|min:0',
            'college' => 'nullable|string|max:255',
            'educational_status_id' => 'required|exists:educational_statuses,id',
        ]);

        // Update freelancer details
        $freelancer->update($request->only([
            'certificate',
            'graduation_year',
            'portfolio',
            'educational_files',
            'experiance',
            'college',
            'educational_status_id'
        ]));
        return $freelancer;
    }

    public function destroy(Freelancer $freelancer)
    {
        // Delete a freelancer
        $freelancer->delete();
        return response()->json(['message' => 'Freelancer deleted successfully.'], 204);
    }
}
