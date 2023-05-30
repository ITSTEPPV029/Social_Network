<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $guarded = false;

  protected $fillable = [
    'first_name',
    'last_name',
    'nick_name',
    'email',
    'password',
    'date_of_birth',
    'age',
    'gender',
    'city',
    'about_me',
    'latitude',
    'longitude',
  ];

   protected $hidden = [
    'password',
    'remember_token',
  ];

  public function myPost()
  {
    return $this->hasMany(MyPost::class);
  }

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
  //при звернені поверне друзів і ті кому відправлені запити на дружбу 
  public function friendsOfMine()
  {
    return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
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
        return (bool) $this->friends()->where('id',$user->id)->count();
        //return (bool) $this->friendsOfMine()->wherePivot('friend_id',$user->id)->count();
            
     }
//перевіряєм чи є запити на дружбу 
public function checkFriendsRequest(User $user)
{
  return  (bool) $this->friendsOfMine()->wherePivot('friend_request',false)->wherePivot('friend_id',$user->id,false)->count();      
}


//повертає не друзів (доробити)
public function  notFriend(User $user)
{
     return $this->friendsOf()->wherePivotNotIn('user_id',$user->id)->get();
}

//хто відправив повідомлення
public function sentMessages()
{
  return $this->hasMany(Message::class, 'sender_user_id', 'id');
}
// хто отримав  повідомлення 
public function receivedMessages()
{
  return $this->hasMany(Message::class, 'recipient_user_id', 'id');
}

//видалення з друзів
public function deleteFriend(User $user)
{
  $this->friendsOf()->detach($user);
  $this->friendsOfMine()->detach($user);
}


  public function pets()
  {
    return $this->hasMany(Pet::class);
  }




}
