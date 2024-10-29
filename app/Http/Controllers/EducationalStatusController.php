<?php

namespace App\Http\Controllers;

use App\Models\EducationalStatus;
use Illuminate\Http\Request;

class EducationalStatusController extends Controller
{
    public function index()
    {
        return EducationalStatus::all(); // Retrieve all educational statuses
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:educational_statuses',
            'user_id' => 'required|exists:users,id',
        ]);

        return EducationalStatus::create($request->only(['name', 'user_id']));
    }

    public function show(EducationalStatus $Educational_status)
    {
        return $Educational_status; 
    }

    public function update(Request $request, EducationalStatus $Educational_status)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:educational_statuses,name,' . $Educational_status->id,
        ]);

        $Educational_status->update($request->only(['name']));
        return $Educational_status;
    }

    public function destroy(EducationalStatus $Educational_status)
    {
        $Educational_status->delete(); 
        return response()->json(['message' => 'Educational status deleted successfully.'], 204);
    }
}
