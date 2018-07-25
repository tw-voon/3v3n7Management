<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    protected $table = "roles";
    protected $primaryKey = "id";
    protected $fillable = ['roles_name'];
}
