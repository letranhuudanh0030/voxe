<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;

    protected $fillable = ['title', 'str_id', 'price', 'dis_price', 'product_category_id', 'brand_id', 'avatar_image', 'short_desc', 'content', 'publish', 'highlight', 'meta_title', 'meta_keywords', 'meta_desc', 'slug', 'sort_order', 'images', 'lastest'];

    protected $sortable = ['id', 'price', 'dis_price', 'proudct_category_id', 'brand_id', 'sort_order', 'created_at', 'updated_at'];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class);
    }

    public function language()
    {
        return $this->belongsToMany(Language::class, 'product_language', 'product_id', 'language_id')->withPivot('title', 'short_desc', 'content', 'meta_title', 'slug', 'meta_keyword', 'meta_desc');
    }

    public function color()
    {
        return $this->belongsToMany(Color::class, 'product_color','product_id', 'color_id');
    }

    public function Size()
    {
        return $this->belongsToMany(Size::class, 'product_size','product_id', 'size_id');
    }

    public static function getProductsPublishByCategoryAndPaginate($category, $perPage)
    {
        return Product::orderBy('created_at', 'desc')->where('product_category_id', $category->id)->where('publish', 1)->paginate($perPage);
    }

    public static function getProductPublishById($id)
    {
        return Product::where('id', $id)->where('publish', 1)->first();
    }

    public static function getProductsPublish()
    {
        return Product::orderBy('created_at', 'desc')->where('publish', 1)->paginate(12);
    }
}
