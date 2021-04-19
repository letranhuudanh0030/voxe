<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['title', 'avatar_image', 'link', 'publish', 'meta_title', 'meta_keywords', 'meta_desc'];
}
