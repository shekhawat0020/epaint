<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['event_name', 'event_date', 'event_time', 'city', 'venue', 'exhibition_name','stall_number', 'photo'];
    public $timestamps = false;
}
