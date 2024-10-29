<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'category_name' =>'required|string|max:255',
            'user_id'=>'required|string',
            'category_group_id'=>'required|string',
        ]);
        $categories=Category::create($validatedData);
        return [$categories];
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $categories)
    {
        return [$categories];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $categories)
    {
        $validatedData=$request->validate([
            'category_name' =>'required|string|max:255',
            'user_id'=>'required|string',
            'category_group_id'=>'required|string',
        ]);
        $categories->update($validatedData);
        return [$categories];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $categories)
    {
        $categories->delete();
        return ['message' => 'Deleted Successfully'];
    }
}
