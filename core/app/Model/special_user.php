<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class special_user extends Model
{
    protected $table = "event_special_user";
    protected $primaryKey = "id";
    protected $fillable = ['event_id', 'user_id', 'status_id'];

    public function user(){
    	return $this->hasOne(\App\User::class, 'id', 'user_id');
    }

    /*
		per events, we will assign user that is choosen by the agency to this table
		this table will keep track which VIP and officer in charge for this events
		status id indicate that this user is taking their roles for this events
		if user fail to do so. status id will become 0.
    */
}
