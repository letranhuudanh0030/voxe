<?php

namespace App\Providers;

use App\ArticleCategory;
use App\ConfigContact;
use App\ConfigGeneral;
use App\Display;
use App\Language;
use App\Menu;
use App\MenuLocation;
use App\Partner;
use App\ProductCategory;
use App\Social;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $menus = Menu::orderBy('sort_order', 'desc')->where('publish', 1)->get();
        $articleCate = ArticleCategory::where('publish', 1)->get();
        $productCate = ProductCategory::with('products')->where('publish', 1)->get();
        $configContact = ConfigContact::first();
        $configGeneral = ConfigGeneral::first();
        $menuLocation = MenuLocation::where('publish', 1)->get();
        $socials = Social::orderBy('sort_order', 'desc')->where('publish', 1)->get();
        $partners = Partner::where('publish', 1)->get();
        $url_contact = ArticleCategory::select('slug')->where('publish', 1)->where('page_type', 1)->first();
        $languages = Language::where('publish', 1)->get();
        $display = Display::first();
        $color_menu = explode(';', $display->color_menu);
        $color_footer = explode(';', $display->color_footer);
        $color_copyright = explode(';', $display->color_copyright);

        Collection::macro('collect_paginate', function($perPage, $pageName = 'page', $total = null,  $page = null) {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });


        view()->share([
            'articleCate' => $articleCate,
            'productCate' => $productCate,
            'configContact' => $configContact,
            'menus' => $menus,
            'menuLocation' => $menuLocation,
            'socials' => $socials,
            'display' => $display,
            'color_menu' => $color_menu,
            'color_footer' => $color_footer,
            'color_copyright' => $color_copyright,
            'partners' => $partners,
            'configGeneral' => $configGeneral,
            'url_contact' => $url_contact,
            'languages' => $languages
        ]);
    }
}
