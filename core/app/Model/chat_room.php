<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class chat_room extends Model
{

    protected $table = "event_chat_room";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'member_count'];

    public function handler(){
    	return $this->hasMany(chat_handler::class, 'room_id', 'id')->latest();

    }

    public function last_message(){
    	return $this->hasOne(chat_message::class, 'chat_room_id', 'id')->latest();
    }

    public function message(){
    	return $this->hasMany(chat_message::class, 'chat_room_id', 'id');
    }
}
