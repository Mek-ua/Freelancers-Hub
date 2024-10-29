<?php

namespace App\Http\Controllers;

use App\Models\ProjectSkill;
use Illuminate\Http\Request;

class ProjectSkillController extends Controller
{
    public function index()
    {
        // Retrieve all project skills with related project and skill
        return ProjectSkill::with('project', 'skillList')->get();
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'skill_list_id' => 'required|exists:skill_lists,id',
        ]);

        // Create a new project skill
        return ProjectSkill::create($request->only(['project_id', 'skill_list_id']));
    }

    public function show(ProjectSkill $Project_skills)
    {
        // Return a specific project skill with related project and skill
        return $Project_skills->load('project', 'skillList');
    }

    public function update(Request $request, ProjectSkill $Project_skills)
    {
        // Validate the request
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'skill_list_id' => 'required|exists:skill_lists,id',
        ]);

        // Update project skill
        $Project_skills->update($request->only(['project_id', 'skill_list_id']));
        return $Project_skills;
    }

    public function destroy(ProjectSkill $Project_skills)
    {
        // Delete a project skill
        $Project_skills->delete();
        return response()->json(['message' => 'Project skill deleted successfully.'], 204);
    }
}
