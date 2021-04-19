<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Partner;
use App\Product;
use App\ProductCategory;
use App\RealEstate;
use App\Slide;
use App\Video;

class DashboardController extends Controller
{
    public function index()
    {
        $count_product = Product::all()->count();
        $count_estate = RealEstate::all()->count();
        $count_category_product = ProductCategory::all()->count();
        $count_article = Article::all()->count();
        $count_slide = Slide::all()->count();
        $count_partner = Partner::all()->count();
        $count_video = Video::all()->count();
        return view('admin.dashboard')->with('count_product', $count_product)
                                    ->with('count_category_product', $count_category_product)
                                    ->with('count_article', $count_article)
                                    ->with('count_slide', $count_slide)
                                    ->with('count_partner', $count_partner)
                                    ->with('count_video', $count_video)
                                    ->with('count_estate', $count_estate);
    }
}
