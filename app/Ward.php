<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $guarded = [];

    public function estate()
    {
        return $this->hasMany(RealEstate::class, 'ward_code');
    }

}
