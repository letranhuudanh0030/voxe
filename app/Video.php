<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'link', 'publish', 'meta_title', 'meta_keywords', 'meta_desc'];

    public static function getVideosPublish()
    {
        return Video::where('publish', 1)->get();
    }
}
