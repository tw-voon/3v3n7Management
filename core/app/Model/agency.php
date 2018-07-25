<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class agency extends Model
{
    protected $table = "event_agency";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'description', 'status'];
}
