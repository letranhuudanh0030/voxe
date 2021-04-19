<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'url', 'new_tab', 'module', 'module_id', 'module_item', 'publish', 'location_id'];

    public function location()
    {
        return $this->belongsTo(MenuLocation::class, 'location_id');
    }

    public function categoryP()
    {
        return $this->belongsTo(ProductCategory::class, 'module_item');
    }

    public function categoryA()
    {
        return $this->belongsTo(ArticleCategory::class, 'module_item');
    }

    public function language()
    {
        // return $this->belongsToMany(Language::class, 'menu_language');
        return $this->belongsToMany(Language::class, 'menu_language', 'menu_id', 'language_id' )->withPivot('title', 'url');
    }


}
