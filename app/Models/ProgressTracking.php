<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'message',
        'proffesional_id',
        'contract_id',
    ];

    protected $casts = [
        'file' => 'array', // Cast the file attribute to an array
    ];

    // Define the relationship with the User model (Professional)
    public function professional()
    {
        return $this->belongsTo(User::class, 'proffesional_id');
    }

    // Define the relationship with the Contract model
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
