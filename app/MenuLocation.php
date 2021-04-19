<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuLocation extends Model
{
    protected $fillable = ['title', 'keyword', 'sort_order', 'publish', 'user_name'];


    public function menu()
    {
        return $this->hasMany(Menu::class, 'location_id', 'id');
    }
}
