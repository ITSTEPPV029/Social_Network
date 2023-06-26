<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyPost extends Model
{
    use HasFactory;
    protected $guarded=false;
    
    protected $fillable = [
        'user_id',
        'like',
        'nick_name',
        'photo',
        'text',];

    public function user()
    {
        return $this->belongsTo(User::class ,"user_id","id");
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->with('user');
    }

    public function savePost()
    {
        return $this->hasMany(SavePost::class); 
    }
    
    public function repostedUser()
    {
        return $this->belongsTo(User::class, 'reposted_user_id');
    }

}
