<?php

namespace App\Http\Controllers;

use App\Models\NotificationMessage;
use Illuminate\Http\Request;

class NotificationMessageController extends Controller
{
    public function index()
    {
        // Retrieve all notification messages
        return NotificationMessage::with('user')->get();
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'message' => 'required|string',
            'user_id' => 'required|exists:users,id', // Ensure the user exists
        ]);

        // Create and return the new notification message
        return NotificationMessage::create($request->only(['message', 'user_id']));
    }

    public function show(NotificationMessage $Notification_messages)
    {
        // Return a specific notification message
        return $Notification_messages;
    }

    public function update(Request $request, NotificationMessage $Notification_messages)
    {
        // Validate the incoming request
        $request->validate([
            'message' => 'required|string',
        ]);

        // Update and return the notification message
        $Notification_messages->update($request->only(['message']));
        return $Notification_messages;
    }

    public function destroy(NotificationMessage $Notification_messages)
    {
        // Delete the notification message
        $Notification_messages->delete();
        return response()->json(['message' => 'Notification message deleted successfully.'], 204);
    }
}
