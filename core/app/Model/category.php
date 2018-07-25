<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = "event_categories";
    protected $primaryKey = "id";
    protected $fillable = ['category_name'];
}
