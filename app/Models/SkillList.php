<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillList extends Model
{
    use HasFactory;
    protected $fillable = [
        'skill_name',
        'user_id',
        'skill_group_id',
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }

 
    public function skillGroup()
    {
        return $this->belongsTo(SkillGroup::class);
    }

    public function freelancers()
{

    return $this->belongsToMany(Freelancer::class, 'freelancer_skills');
}

public function projects()
{
    return $this->belongsToMany(Project::class, 'project_skills');
}
}
