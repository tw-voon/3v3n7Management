<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class response extends Model
{
    protected $table = "event_response";
    protected $primaryKey = "id";
    protected $fillable = ['user_id', 'event_id', 'support', 'bookmark'];
}
