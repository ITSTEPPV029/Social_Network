<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavePost extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'my_post_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function savePostCategory()
    {
       
       //return $this->hasMany(SavePostCategory::class);
        return $this->belongsTo(SavePostCategory::class, "category_id", "id");
    }

    public function myPost()
    {
        return $this->belongsTo(MyPost::class);
    }

    
}
