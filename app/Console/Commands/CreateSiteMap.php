<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sitemap = App::make("sitemap");

        $sitemap->add(\URL::to('/'), Carbon::now(), '1.0', 'daily');

        $articles = DB::table('articles')->orderBy('created_at', 'desc')->get();

        $products = DB::table('products')->orderBy('created_at', 'desc')->get();

        $productCategories = DB::table('product_categories')->orderBy('created_at', 'desc')->get();

        $articleCategories = DB::table('article_categories')->orderBy('created_at', 'desc')->get();

        $menus = DB::table('menus')->orderBy('created_at', 'desc')->get();


        foreach ($articles as $article) {
            $sitemap->add(route('news', ['slug' => $article->slug, 'id' => $article->id]), $article->updated_at, 1, 'daily');
        }

        foreach ($products as $product) {
            $sitemap->add(route('single', ['slug' => $product->slug, 'id' => $product->id]), $product->updated_at, 1, 'daily');
        }

        foreach ($productCategories as $productCategory) {
            if($productCategory->parent_id != 0){

                $sitemap->add(route('categoryP', ['slug' => $productCategory->slug, 'id' => $productCategory->id]), $productCategory->updated_at, 1, 'daily');
            }
        }

        foreach ($articleCategories as $articleCategory) {
            if(!$articleCategory->one_article && !$articleCategory->link){

                $sitemap->add(route('categoryA', ['slug' => $articleCategory->slug, 'id' => $articleCategory->id]), $articleCategory->updated_at, 1, 'daily');
            }
        }

        foreach ($menus as $menu) {
            if($menu->url && $menu->url != '/'){

                $sitemap->add(route('menu', ['slug' => $menu->url]), $menu->updated_at, 1, 'daily');
            }
        }

        // $sitemap->store('xml', 'sitemap');
        $sitemap->store('xml', 'sitemap', '/home/hoangloivoxe/public_html', '/home/hoangloivoxe/public_html/vendor/sitemap/styles/sitemapindex.xsl');
    }
}
