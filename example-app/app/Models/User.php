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
//при звернені поверне друзів і ті кому відправлені запити на дружбу 
     public function friendsOfMine()
      {
        return $this->belongsToMany(User::class ,'friends','user_id','friend_id');
      }
  //поверне хто не є другом
      public function friendsOf()
      {
        return $this->belongsToMany(User::class ,'friends','friend_id','user_id');
      }
//поверне друзів
     public function friends()
      {
        return $this->friendsOfMine()->wherePivot('friend_request',true)->get()
        ->merge($this->friendsOf()->wherePivot('friend_request',true)->get());
      }
//поверне запити на дружбу 
      public function friendsRequest()
      {
        return $this->friendsOf()->wherePivot('friend_request',false)->get();       
      }
//перевірка чи друг 
     public function checkIfFriend(User $user)
     {
        return (bool) $this->friendsOfMine()->wherePivot('friend_id',$user->id)->count();
        // if($this->friendsOfMine()->wherePivot('friend_id',$user->id)->count())
        //   return 1;    
        // else
        //   return 0;      
     }

      // public function  getAvatarPath($userId)
      // {
      //   $path ="uploads/avatar/id{$userId}";
      //        if(!file_exists("{$path}"))
      //        {
      //              mkdir("{$path}",0777,true);
      //        }
      //     return "/{$path}/";
      // }
}
