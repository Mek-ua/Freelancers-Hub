<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'how_long',
        'cover_letter',
        'file',
        'propose_price',
        'user_id',
        'projects_id',
    ];

    // Relationship to User (freelancer submitting the proposal)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Project
    public function project()
    {
        return $this->belongsTo(Project::class, 'projects_id');
    }
}
