<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['name', 'name_code', 'avatar_image', 'publish'];

    public function menu()
    {
        return $this->belongsToMany(Menu::class, 'menu_language', 'menu_id', 'language_id' )->withPivot('title', 'url');
    }
}
