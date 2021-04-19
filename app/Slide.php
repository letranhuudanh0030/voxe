<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['title', 'avatar_image', 'link', 'publish', 'meta_title', 'meta_keywords', 'meta_desc'];

    public static function getSlidesPublish()
    {
        return Slide::where('publish', 1)->get();
    }
}
