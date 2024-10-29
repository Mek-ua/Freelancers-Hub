<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'user_id',
        'category_group_id',
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoryGroup()
    {
        return $this->belongsTo(CategoryGroup::class);
    }
    
    public static function getUserCategories($userId)
     {
         return self::where('user_id', $userId)->get();
     }

     
}
