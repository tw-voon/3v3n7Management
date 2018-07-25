<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class assign extends Model
{
    protected $table = "event_assigns";
    protected $primaryKey = "id";
    protected $fillable = ['officer_id', 'event_id'];

    public function user(){
    	return $this->hasOne(\App\User::class, 'id', 'officer_id');
    }
}
