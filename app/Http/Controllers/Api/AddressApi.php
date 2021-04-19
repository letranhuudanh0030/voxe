<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\District;
use App\Http\Controllers\Controller;
use App\Ward;
use Illuminate\Http\Request;

class AddressApi extends Controller
{
    public function getCity()
    {
        $cities = City::all();
        return response($cities, 200);
    }

    public function getDistrictOfCity($city)
    {
        $districts = District::where('city_code', $city)->get();
        return response($districts, 200);
    }

    public function getWardOfDistrict($district)
    {
        $wards = Ward::where('district_code', $district)->get();
        return response($wards, 200);
    }
}
