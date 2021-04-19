<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigContact extends Model
{
    protected $fillable = ['footer', 'contact_page', 'support', 'email_name', 'email_rece'];

    public function language()
    {
        return $this->belongsToMany(Language::class,'contact_language', 'contact_id', 'language_id')->withPivot('footer', 'contact_page', 'support', 'work_footer', 'commit_footer');
    }

}
