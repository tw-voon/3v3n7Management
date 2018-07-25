<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    protected $table = "event_feedback";
    protected $primaryKey = "id";
    protected $fillable = ['event_id', 'user_id', 'message', 'rating'];

    public function user(){
    	return $this->hasOne(\App\User::class, 'id', 'user_id');
    }
}
