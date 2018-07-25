<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $table = "event_comment";
    protected $primaryKey = "id";
    protected $fillable = ['event_id', 'user_id', 'message'];

    public function comment_belong_to(){
    	return $this->hasOne(\App\User::class, 'id', 'user_id');
    }
}
