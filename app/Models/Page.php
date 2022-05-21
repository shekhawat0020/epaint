<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'details','meta_tag','meta_description', 'footer_menu', 'redirect_url'];
    public $timestamps = false;
}
