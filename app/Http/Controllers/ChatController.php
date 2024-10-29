<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        // Retrieve all chats
        return Chat::with(['sender', 'receiver'])->get();
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'is_read' => 'required|boolean',
        ]);

        // Create and return the new Chats message
        return Chat::create($request->only(['sender_id', 'receiver_id', 'message', 'is_read']));
    }

    public function show(Chat $Chats)
    {
        // Return a specific Chats message
        return $Chats;
    }

    public function update(Request $request, Chat $Chats)
    {
        // Validate the incoming request
        $request->validate([
            'is_read' => 'required|boolean',
        ]);

        // Update and return the Chats message
        $Chats->update($request->only(['is_read']));
        return $Chats;
    }

    public function destroy(Chat $Chats)
    {
        // Delete the Chats message
        $Chats->delete();
        return response()->json(['message' => 'Chats message deleted successfully.'], 204);
    }
}
