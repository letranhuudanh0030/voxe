<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ProductCategory extends Model
{

    use Sortable;

    protected $fillable = ['name', 'parent_id', 'avatar_image', 'short_desc', 'ad_content', 'publish', 'highlight', 'meta_title', 'meta_keyswords', 'meta_desc', 'slug', 'sort_order'];

    protected $sortable = ['id', 'name', 'sort_order'];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }

    public function menu()
    {
        return $this->hasMany(Menu::class, 'module_item', 'id');
    }

    public function language()
    {
        return $this->belongsToMany(Language::class, 'product_category_language', 'product_category_id', 'language_id')->withPivot('title', 'short_desc', 'content', 'meta_title', 'slug', 'meta_keyword', 'meta_desc');
    }

    public function estate()
    {
        return $this->hasMany(RealEstate::class, 'product_category_id');
    }

    public static function getCategoryPublishBySlug($slug)
    {
        return ProductCategory::where('slug', $slug)->where('publish', 1)->first();
    }

    public static function getCategoriesPublishByCateParent($cate)
    {
        return ProductCategory::where('parent_id', $cate->id)->where('publish', 1)->get();
    }

    public static function getCategoriesPublish()
    {
        return ProductCategory::where('publish', 1)->get();
    }

    public static function getCategoriesPublishAndHighlight()
    {
        return ProductCategory::where('publish', 1)->where('highlight', 1)->get();
    }
}
