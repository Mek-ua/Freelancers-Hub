<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;



class ProjectController extends Controller implements HasMiddleware
{
  public static function middleware()
  {
    return [
         new Middleware('auth:sanctum',except:['index','show'])
        ];
  }


    public function index()
    {
        return project::all(); 
    }

    public function store(Request $request)
    {
         $validatedData=$request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'attached_file' => 'nullable|json',
            'price' => 'required|numeric',
            'user_id' => 'required|exists:users,id', 
        ]);
       
         $project = $request->user()->projects()->create($validatedData);
          return $project;
    }

    public function show(project $project)
    {
        return $project; 
    }

    public function update(Request $request, project $projects)
    {
        Gate::authorize('modify', $projects);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'attached_file' => 'nullable|json',
            'price' => 'required|numeric',
        ]);

        $projects->update($request->only(['title', 'description', 'attached_file', 'price']));
        return $projects;
    }

    public function destroy(project $projects)
    {
        Gate::authorize('modify', $projects);
        $projects->delete(); 
        return response()->json(['message' => 'projects deleted successfully.'], 204);
    }
}
