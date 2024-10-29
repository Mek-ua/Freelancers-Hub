<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $table = 'payment_methods';

    
    protected $fillable = [
        'name',
        'api_address',
        'token',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
