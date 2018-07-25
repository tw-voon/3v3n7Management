<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class attendees extends Model
{
    protected $table = "event_attendees";
    protected $primaryKey = "id";
    protected $fillable = ['user_id', 'event_id'];

    public function user(){
    	return $this->hasOne(\App\User::class, 'id', 'user_id');
    }
}
