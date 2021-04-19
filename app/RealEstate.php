<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    protected $guarded = [];


    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_code', 'code');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_code', 'code');
    }

    public function language()
    {
        return $this->belongsToMany(Language::class, 'real_estate_language', 'estate_id', 'language_id')->withPivot('title', 'contact', 'description','condition', 'functional_subdivision', 'infrastructure', 'investment_costs', 'career', 'incentives', 'suport', 'meta_title', 'slug', 'meta_keyword', 'meta_desc');
    }

}
