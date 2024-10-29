<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
   
    public function index()
    {
        return Role::all();
    }

    public function show($id)
    {
        return Role::findOrFail($id);
    }

    public function store(Request $request)
    {
        $role = Role::create($request->only('name', 'type'));
        return [$role, 201];
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->only('name', 'type'));
        return $role;
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return ['message' => 'Role deleted successfully'];
    }
}
