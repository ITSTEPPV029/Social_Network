<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

     public function friendsOfMine()
      {
        return $this->belongsToMany(User::class ,'friends','user_id','friend_id');
      }
      
      public function friendsOf()
      {
        return $this->belongsToMany(User::class ,'friends','friend_id','user_id');
      }

     public function friends()
      {
        return $this->friendsOfMine()->wherePivot('friend_request',true)->get()
        ->merge($this->friendsOf()->wherePivot('friend_request',true)->get());
      }

      public function friendsRequest()
      {
        return $this->friendsOfMine()->wherePivot('friend_request',false)->get();       
      }


    protected $fillable = [
        'first_name',
        'last_name',
        'nick_name',
        'email',
        'password',];

      
       protected $hidden = [
           'password',
           'remember_token',
       ];
   
 
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
}
