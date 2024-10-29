<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::with(['role', 'country'])->get());
    }

    public function show($id)
    {
        $user = User::with(['role', 'country'])->find($id);
        
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'phone_number' => 'required|string|max:15',
        'address' => 'required|string',
        'role_id' => 'required|exists:roles,id',
        'country_id' => 'required|exists:countries,id',
        'photo' => 'sometimes|nullable|string',
    ]);

    // Handle file upload
    // if ($request->hasFile('photo')) {
    //     $filePath = $request->file('photo')->store('photos', 'public'); // Ensure you have a 'photos' directory in 'storage/app/public'
    //     $validatedData['photo'] = $filePath; // Store the file path
    // }
    if ($request->has('photo') && $request->photo === null) {
        $validatedData['photo'] = null; // Set photo to null
    }

    $validatedData['password'] = Hash::make($validatedData['password']);

    $user = User::create($validatedData);

    return response()->json($user, 201);
}

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validatedData = $request->validate([
            'full_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
            'status' => 'sometimes|integer',
            'photo' => 'sometimes|nullable|string',
            'phone_number' => 'sometimes|required|string|max:15',
            'address' => 'sometimes|required|string',
            'role_id' => 'sometimes|required|exists:roles,id',
            'country_id' => 'sometimes|required|exists:countries,id',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 204);
        
}
}