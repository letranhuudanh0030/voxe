<?php

namespace App\Http\Traits;

use App\ArticleCategory;
use App\ProductCategory;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Support
 */
trait MyTrait
{
    public static function checkCategoryMenu($page)
    {
        $category_menu = null;
        if($page->module == 'article_catalogua'){
            $category_menu = ArticleCategory::where('id', $page->module_id)->first();
        } else {
            $category_menu = ProductCategory::where('id', $page->module_id)->first();
        }
        return $category_menu;
    }

    public static function checkPageRoute($page_type)
    {
        $route = null;
        switch ($page_type) {
            case 1:
                $route = 'contact';
                break;
            case 2:
                $route = 'home';
                break;
            case 3:
                $route = 'gallery';
                break;
            case 4:
                $route = 'about';
                break;
            case 5:
                $route = 'cart';
                break;
            case 6:
                $route = 'checkout';
                break;
            case 7:
                $route = 'news_list';
                break;
            case 8:
                $route = 'news_list';
                break;
            case 9:
                $route = 'news_list';
                break;
            case 10:
                $route = 'news_list';
                break;
            case 11:
                $route = 'news_list';
                break;
            case 12:
                $route = 'news_list';
                break;
            case 13:
                $route = 'news_list';
                break;
            default:
                $route = '';
                break;
        }
        return $route;
    }

    public static function array_pagination($items, $perPageNumber)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($items);
        $perPage = $perPageNumber;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $products = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $products->setPath(request()->url);
        return $products;
    }

    public static function getProductsByCategoryList($categories, $category)
    {
        $items = null;
                
        foreach ($categories as $cate_parent) {
            $sub_cates = ProductCategory::where('parent_id', $cate_parent->id)->where('publish', 1)->get();
            foreach ($sub_cates as $sub_cate) {
                foreach ($sub_cate->estate()->orderBy('sort_order', 'desc')->where('publish', 1)->get() as $product) {
                    if ($product->productCategory->parent_id != $category->id && $category->parent_id == 0) {
                        $items[] = $product;
                    } else if($product->productCategory->parent_id == $category->id){
                        $items[] = $product;
                    }
                }
            }
        }

        return $items;
    }
}


