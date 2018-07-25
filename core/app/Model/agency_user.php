<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class agency_user extends Model
{
    protected $table = "event_agency_users";
    protected $primaryKey = "id";
    protected $fillable = ['agency_id', 'user_id', 'status'];

    public function agency(){
    	return $this->hasOne(agency::class, 'id', 'agency_id');
    }

    public function user(){
    	return $this->hasOne(\App\User::class, 'id', 'user_id');
    }
}
