<?php

namespace App\Http\Controllers;

use App\Models\SkillGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillGroupController extends Controller
{
    public function index()
    {
        return SkillGroup::where('user_id', Auth::id())->get(); 
    }

    public function store(Request $request)
    {
       $validatedData= $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',  
        ]);

        return SkillGroup::create($validatedData);
    }

    public function show(SkillGroup $Skill_groups)
    {
        return $Skill_groups; 
    }

    public function update(Request $request, SkillGroup $Skill_groups)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $Skill_groups->update($request->only(['name'])); 
        return $Skill_groups;
    }

    public function destroy(SkillGroup $Skill_groups)
    {
        $Skill_groups->delete(); 
        return response()->json(['message' => 'Skill group deleted successfully.'], 204);
    }
}
