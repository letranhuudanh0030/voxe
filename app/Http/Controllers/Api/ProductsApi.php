<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Http\Resources\Products as ProductResource;

class ProductsApi extends Controller
{

    public function getProductList()
    {

        $products = Product::with('Size')->with('productCategory')->orderBy('sort_order', 'desc')->get();

        return ProductResource::collection($products);
        // return response($products, 200);

    }

    public function getProductSingle($id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
        // return response($product, 200);
    }

}
