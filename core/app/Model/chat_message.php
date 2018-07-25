<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class chat_message extends Model
{
    protected $table = "event_chat_message";
    protected $primaryKey = "id";
    protected $fillable = ['chat_room_id', 'user_id', 'message'];

    public function user(){
    	return $this->hasOne(\App\User::class, 'id', 'user_id');
    }

    public function room(){
    	return $this->hasOne(chat_room::class, 'id', 'chat_room_id');
    }
}
