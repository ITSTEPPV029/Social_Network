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
    
}
