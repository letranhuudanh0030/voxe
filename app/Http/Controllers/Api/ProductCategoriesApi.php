<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;

class ProductCategoriesApi extends Controller
{
    public function getCategories()
    {
        $categories = ProductCategory::all();
        return response($categories, 200);
    }

    public function getCategory($id)
    {
        $category = ProductCategory::findOrFail($id);
        return response($category, 200);
    }
}
