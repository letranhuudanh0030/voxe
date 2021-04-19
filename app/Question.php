<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];


    public function language()
    {
        return $this->belongsToMany(Language::class, 'question_language', 'question_id', 'language_id')->withPivot('question', 'anwser');
    }
}
