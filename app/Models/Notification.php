<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_message',
        'seen',
        'notification_message_id',
        'user_id',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the NotificationMessage model
    public function notificationMessage()
    {
        return $this->belongsTo(NotificationMessage::class);
    }
}
