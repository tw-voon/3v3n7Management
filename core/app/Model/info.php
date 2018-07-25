<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class info extends Model
{
    protected $table = "info";
    protected $primaryKey = "id";
    protected $fillable = ['source'];
}
