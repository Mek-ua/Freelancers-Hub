<?php

namespace App\Http\Controllers;

use App\Models\CategoryGroup;
use Illuminate\Http\Request;

class CategoryGroupController extends Controller
{

    public function index()
    {
        return response()->json(CategoryGroup::with('user')->get());

    }

   
    public function show($id)
    {
        $Category_groups = CategoryGroup::with('user')->find($id);

        if (!$Category_groups) {
            return response()->json(['message' => 'Category Group not found'], 404);
        }

        return response()->json($Category_groups);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $Category_groups = CategoryGroup::create($validatedData);

        return response()->json($Category_groups, 201);
    }

    // Update an existing category group
    public function update(Request $request, $id)
    {
        $Category_groups = CategoryGroup::find($id);
        
        if (!$Category_groups) {
            return response()->json(['message' => 'Category Group not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $Category_groups->update($validatedData);

        return response()->json($Category_groups);
    }

    // Delete a category group
    public function destroy($id)
    {
        $Category_groups = CategoryGroup::find($id);
        
        if (!$Category_groups) {
            return response()->json(['message' => 'Category Group not found'], 404);
        }

        $Category_groups->delete();

        return response()->json(['message' => 'Category Group deleted successfully']);
    }
}
