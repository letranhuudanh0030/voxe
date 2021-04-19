<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'avatar_image', 'link', 'sort_order', 'publish'];

}
