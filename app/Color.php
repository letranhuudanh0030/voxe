<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_color', 'product_id', 'color_id');
    }
}
