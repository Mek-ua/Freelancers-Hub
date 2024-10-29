<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index()
    {
        // Retrieve all proposals with related project and user data
        return Proposal::with('user', 'project')->get();
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'how_long' => 'required|integer',
            'cover_letter' => 'required|string',
            'file' => 'nullable|json',
            'propose_price' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'projects_id' => 'nullable|exists:projects,id',
        ]);

        // Create and return the new proposal
        return Proposal::create($request->only(['how_long', 'cover_letter', 'file', 'propose_price', 'user_id', 'projects_id']));
    }

    public function show(Proposal $Proposals)
    {
        // Return a specific Proposals with related user and project data
        return $Proposals->load('user', 'project');
    }

    public function update(Request $request, Proposal $Proposals)
    {
        // Validate the incoming request
        $request->validate([
            'how_long' => 'required|integer',
            'cover_letter' => 'required|string',
            'file' => 'nullable|json',
            'propose_price' => 'required|numeric',
        ]);

        // Update and return the Proposals
        $Proposals->update($request->only(['how_long', 'cover_letter', 'file', 'propose_price']));
        return $Proposals;
    }

    public function destroy(Proposal $Proposals)
    {
        // Delete the Proposals
        $Proposals->delete();
        return response()->json(['message' => 'Proposals deleted successfully.'], 204);
    }
}
