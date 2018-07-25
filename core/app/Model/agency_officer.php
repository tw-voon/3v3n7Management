<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class agency_officer extends Model
{
    protected $table = "event_agency_officer";
    protected $primaryKey = "id";
    protected $fillable = ['agency_user_id', 'user_id', 'status'];

    public function user(){
    	return $this->hasOne(\App\User::class, 'id', 'user_id');
    }

    public function agency_user(){
    	return $this->hasOne(\App\User::class, 'id', 'agency_user_id');
    }
}
