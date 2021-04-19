<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    // dd(123);
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('products', 'Api\ProductsApi@getProductList');
    Route::get('products/{id}', 'Api\ProductsApi@getProductSingle');

    Route::get('categories', 'Api\ProductCategoriesApi@getCategories');
    Route::get('categories/{id}', 'Api\ProductCategoriesApi@getCategory');

    Route::get('cities', 'Api\AddressApi@getCity');
    Route::get('cities/{id}/districts', 'Api\AddressApi@getDistrictOfCity');
    Route::get('districts/{id}/wards', 'Api\AddressApi@getWardOfDistrict');
});




