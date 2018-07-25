<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class event_images extends Model
{
    protected $table = "event_media";
    protected $primaryKey = "id";
    protected $fillable = ['event_id', 'media_type', 'link'];

}
