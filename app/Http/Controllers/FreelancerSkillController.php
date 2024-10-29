<?php

namespace App\Http\Controllers;

use App\Models\FreelancerSkill;
use Illuminate\Http\Request;

class FreelancerSkillController extends Controller
{
    public function index()
    {
        // Get all freelancer skills
        return FreelancerSkill::with('freelancer', 'skillList')->get();
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'freelancer_id' => 'required|exists:freelancers,id',
            'skill_list_id' => 'required|exists:skill_lists,id',
        ]);

        // Create a new freelancer skill
        return FreelancerSkill::create($request->only(['freelancer_id', 'skill_list_id']));
    }

    public function show(FreelancerSkill $Freelancer_skills)
    {
        // Return a specific freelancer skill
        return $Freelancer_skills->load('freelancer', 'skillList');
    }

    public function update(Request $request, FreelancerSkill $Freelancer_skills)
    {
        // Validate the request
        $request->validate([
            'freelancer_id' => 'required|exists:freelancers,id',
            'skill_list_id' => 'required|exists:skill_lists,id',
        ]);

        // Update freelancer skill
        $Freelancer_skills->update($request->only(['freelancer_id', 'skill_list_id']));
        return $Freelancer_skills;
    }

    public function destroy(FreelancerSkill $Freelancer_skills)
    {
        // Delete a freelancer skill
        $Freelancer_skills->delete();
        return response()->json(['message' => 'Freelancer skill deleted successfully.'], 204);
    }
}
