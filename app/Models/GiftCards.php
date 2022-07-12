<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftCards extends Model
{
    protected $fillable = ['name', 'photo'];
    public $timestamps = false;
}
