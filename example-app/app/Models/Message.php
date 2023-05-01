<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function senderUser()
    {
        return $this->belongsTo(User::class ,"sender_user_id","id");
    }
    public function recipientUser()
    {
        return $this->belongsTo(User::class ,"recipient_user_id","id");
    }

}
