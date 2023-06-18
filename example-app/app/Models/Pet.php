<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'avatar',
        'kind_of',
        'gender',
        'age',
        'about',
        'user_id',
    ];

}
