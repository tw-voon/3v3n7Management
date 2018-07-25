<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class chat_deleted extends Model
{
    protected $table = "event_chat_deleted";
    protected $primaryKey = "id";
    protected $fillable = ['user_id', 'msg_id'];

    public function user(){
    	return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function message(){
    	return $this->hasOne(chat_message::class, 'id', 'msg_id');
    }
}
