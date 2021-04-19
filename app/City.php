<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function estate()
    {
        return $this->hasMany(RealEstate::class, 'city_code');
    }
}
