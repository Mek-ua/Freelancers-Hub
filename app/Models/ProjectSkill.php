<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'skill_list_id',
    ];

    // Relationship to Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relationship to SkillList
    public function skillList()
    {
        return $this->belongsTo(SkillList::class);
    }
}
