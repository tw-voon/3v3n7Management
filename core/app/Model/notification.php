<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $table = "event_notification";
    protected $primaryKey = "id";
    protected $fillable = ['specific_user_id', 'action_user', 'action_type', 'event_id', 'content'];
}
