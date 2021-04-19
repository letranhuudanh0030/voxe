<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $guarded = [];

    public function estate()
    {
        return $this->hasMany(RealEstate::class, 'district_code');
    }
}
