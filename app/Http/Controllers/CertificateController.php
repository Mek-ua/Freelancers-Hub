<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        // Retrieve all certificates with the associated freelancer
        return Certificate::with('freelancer')->get();
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'freelancer_id' => 'required|exists:freelancers,id', // Ensure freelancer exists
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'photo' => 'nullable|string|max:255', // Assuming photo is a string (e.g., URL or file path)
        ]);

        // Create and return the new Certificates
        return Certificate::create($request->only(['freelancer_id', 'title', 'company_name', 'photo']));
    }

    public function show(Certificate $Certificates)
    {
        // Return a specific Certificates with its freelancer
        return $Certificates->load('freelancer');
    }

    public function update(Request $request, Certificate $Certificates)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'company_name' => 'sometimes|required|string|max:255',
            'photo' => 'nullable|string|max:255',
        ]);

        // Update and return the Certificates
        $Certificates->update($request->only(['title', 'company_name', 'photo']));
        return $Certificates;
    }

    public function destroy(Certificate $Certificates)
    {
        // Delete the Certificates
        $Certificates->delete();
        return response()->json(['message' => 'Certificates deleted successfully.'], 204);
    }
}
