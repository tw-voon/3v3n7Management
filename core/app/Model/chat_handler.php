<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class chat_handler extends Model
{
    protected $table = "event_chat_handler";
    protected $primaryKey = "id";
    protected $fillable = ['user_id', 'room_id', 'room_name'];

    public function chatroom(){
    	return $this->hasOne(chat_room::class, 'id', 'room_id');
    }
}
