<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class locations extends Model
{
    protected $table = "event_location";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'address', 'lon', 'lat'];
}
