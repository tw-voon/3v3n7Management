<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    protected $table = "events";
    protected $primaryKey = "id";
    protected $fillable = ['category_id', 'agency_id', 'location_id', 'status_id' , 'title', 'description', 'extra_info','support', 'bookmarked', 'start_time', 'end_time'];

    public function media(){
        return $this->hasMany(event_images::class, 'event_id', 'id');
    }

    public function locations(){
    	return $this->hasOne(locations::class, 'id', 'location_id');
    }

    public function comment(){
    	return $this->hasOne(comments::class, 'event_id', 'id');
    }

    public function category(){
        return $this->hasOne(category::class, 'id', 'category_id');
    }

    public function user(){
    	return $this->hasOne(\App\User::class, 'id', 'agency_id');
    }

    public function officer(){
        return $this->hasOne(assign::class, 'event_id', 'id');
    }

}
