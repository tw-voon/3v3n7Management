<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class user_to_roles extends Model
{
    protected $table = "event_user_to_roles";
    protected $primaryKey = "id";
    protected $fillable = ['user_id', 'roles_id'];

    public function roles_name(){
    	return $this->hasOne(roles::class, 'id', 'roles_id');
    }
}
