<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Artisan;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// -----------Layout 5--------------
// Route::group(['middleware' => 'locale'], function () {
//     Route::get('/lang/{locale}', 'Frontend5\FrontendController@changelang')->name('lang');

    // Route::get('/', 'Frontend5\FrontendController@homelang')->name('homelang');
    // Route::get('/'.App\ArticleCategory::where('page_type', 2)->first()->slug.'.html', 'Frontend5\FrontendController@index')->name('home');
    // Route::get('/', 'Frontend5\FrontendController@index')->name('home');
    // Route::get('/{slug}-p{id?}.html', 'Frontend5\FrontendController@singleProduct')->where('slug', '[a-zA-Z0-9-_]+')->where('id', '[0-9]+')->name('single'); // chi tiet san pham
    // Route::get('/{slug}-cp{id?}.html', 'Frontend5\FrontendController@categoryProduct')->where('slug', '[a-zA-Z0-9-_]+')->where('id', '[0-9]+')->name('categoryP'); // danh muc sản phẩm
    // Route::get('/{slug}-c{id?}.html', 'Frontend5\FrontendController@singleArticle')->where('slug', '[a-zA-Z0-9-_]+')->where('id', '[0-9]+')->name('news'); // chi tiet bai viet
    // Route::get('/{slug}-ca{id?}.html', 'Frontend5\FrontendController@categoryArticle')->where('slug', '[a-zA-Z0-9-_]+')->where('id', '[0-9]+')->name('categoryA'); // danh mục bài viết
    // Route::get('/{slug}.html', 'Frontend5\FrontendController@onePage')->name('menu');

    // Route::post('/lien-he/gui-mail', 'Frontend5\FrontendController@sendMail')->name('send.mail');
    // Route::post('/tim-kiem', 'Frontend5\FrontendController@search')->name('search');
    // Route::get('/tim-kiem', 'Frontend5\FrontendController@search')->name('searchAuto');
    // Route::get('/loc', 'Frontend5\FrontendController@filter')->name('filter');

    // Route::post('/gio-hang/add', 'Frontend5\CartController@add')->name('cart.add');
    // Route::post('/gio-hang/update', 'Frontend5\CartController@update')->name('cart.update');
    // Route::post('/gio-hang/remove', 'Frontend5\CartController@remove')->name('cart.remove');
    // Route::get('/gio-hang/clear', 'Frontend5\CartController@clear')->name('cart.clear');

    // Route::post('/thanh-toan', 'Frontend5\CheckoutController@postCheckout')->name('post.checkout');
// });


// -----------Frontend--------------
Route::get('/', 'Frontend\FrontendController@index')->name('home');
Route::get('/{slug}-p{id?}.html', 'Frontend\FrontendController@singleProduct')->where('slug', '[a-zA-Z0-9-_]+')->where('id', '[0-9]+')->name('single'); // chi tiet san pham
Route::get('/{slug}-cp{id?}.html', 'Frontend\FrontendController@categoryProduct')->where('slug', '[a-zA-Z0-9-_]+')->where('id', '[0-9]+')->name('categoryP'); // danh muc sản phẩm
Route::get('/{slug}-c{id?}.html', 'Frontend\FrontendController@singleArticle')->where('slug', '[a-zA-Z0-9-_]+')->where('id', '[0-9]+')->name('news'); // chi tiet bai viet
Route::get('/{slug}-ca{id?}.html', 'Frontend\FrontendController@categoryArticle')->where('slug', '[a-zA-Z0-9-_]+')->where('id', '[0-9]+')->name('categoryA'); // danh mục bài viết
Route::get('/{slug}.html', 'Frontend\FrontendController@onePage')->name('menu');
Route::get('/tim-kiem', 'Frontend\FrontendController@search')->name('search');
Route::post('/lien-he/gui-mail', 'Frontend\FrontendController@sendMail')->name('send.mail');




// -----------Backend--------------
    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

        Route::get('/', 'Admin\DashboardController@index')->name('dashboard');

        Route::post('user/remove', 'Admin\UsersController@remove')->name('user.remove');
        Route::post('user/update-status', 'Admin\UsersController@updateStatus')->name('user.status');
        Route::resource('user', 'Admin\UsersController');


        Route::group(['prefix' => 'realestate'], function () {
            Route::post('/estate/remove', 'Admin\RealEstateController@remove')->name('estate.remove');
            Route::post('/estate/remove-all', 'Admin\RealEstateController@removeAll')->name('estate.remove.all');
            Route::post('/estate/update-status', 'Admin\RealEstateController@updateStatus')->name('estate.status');
            Route::get('/estate/filter', 'Admin\RealEstateController@filter')->name('estate.filter');
            Route::resource('estate', 'Admin\RealEstateController');
        });

        Route::group(['prefix' => 'article'], function () {
            
            Route::post('/catalogue/remove', 'Admin\ArticlesCategoryController@remove')->name('catalogue.remove');
            Route::post('/catalogue/remove-all', 'Admin\ArticlesCategoryController@removeAll')->name('catalogue.remove.all');
            Route::post('/catalogue/search', 'Admin\ArticlesCategoryController@search')->name('catalogue.search');
            Route::get('/catalogue/search/{name}', 'Admin\ArticlesCategoryController@search')->name('catalogue.search.one');
            Route::post('/catalogue/update-status', 'Admin\ArticlesCategoryController@updateStatus')->name('catalogue.status');
            Route::resource('/catalogue', 'Admin\ArticlesCategoryController');
    
            Route::post('/post/remove', 'Admin\ArticlesController@remove')->name('post.remove');
            Route::post('/post/remove-all', 'Admin\ArticlesController@removeAll')->name('post.remove.all');
            Route::get('/post/search', 'Admin\ArticlesController@search')->name('post.search');
            Route::post('/post/update-status', 'Admin\ArticlesController@updateStatus')->name('post.status');
            Route::get('/post/search/{id}', 'Admin\ArticlesController@search')->name('post.search.one');
            Route::resource('/post', 'Admin\ArticlesController');
    
            Route::get('/tag', 'Admin\ArticlesController@tag')->name('tag');
            Route::post('/tag', 'Admin\ArticlesController@postTag')->name('tag.create');
            Route::post('/tag/update', 'Admin\ArticlesController@updateTag')->name('tag.update');
            Route::post('/tag/remove', 'Admin\ArticlesController@removeTag')->name('tag.remove');
            Route::post('/tag/update-status', 'Admin\ArticlesController@updateStatusTag')->name('tag.status');

            Route::post('/question/update-status', 'Admin\QuestionController@updateStatus')->name('question.status');
            Route::post('/question/remove', 'Admin\QuestionController@remove')->name('question.remove');
            Route::post('/question/remove-all', 'Admin\QuestionController@removeAll')->name('question.remove.all');
            Route::resource('/question', 'Admin\QuestionController');
        });

        
        Route::group(['prefix' => 'product'], function () {
            
            Route::post('/product-type/update-status', 'Admin\ProductCategoryController@updateStatus')->name('product-type.status');
            Route::get('/product-type/search', 'Admin\ProductCategoryController@search')->name('product-type.search');
            Route::get('/product-type/search/{name}', 'Admin\ProductCategoryController@search')->name('product-type.search.one');
            Route::post('/product-type/remove', 'Admin\ProductCategoryController@remove')->name('product-type.remove');
            Route::post('/product-type/remove-all', 'Admin\ProductCategoryController@removeAll')->name('product-type.remove.all');
            Route::resource('/product-type', 'Admin\ProductCategoryController');

            Route::get('/products/search', 'Admin\ProductsController@search')->name('products.search');
            Route::post('/products/remove', 'Admin\ProductsController@remove')->name('products.remove');
            Route::post('/products/update-status', 'Admin\ProductsController@updateStatus')->name('products.status');
            Route::post('/products/remove-all', 'Admin\ProductsController@removeAll')->name('products.remove.all');
            Route::get('/products/category-product/{id}', 'Admin\ProductsController@cateproduct')->name('products.cate');
            Route::resource('/products', 'Admin\ProductsController');
      
            Route::get('/color', 'Admin\ProductsController@color')->name('color');
            Route::post('/color', 'Admin\ProductsController@postColor')->name('color.create');
            Route::post('/color/update', 'Admin\ProductsController@updateColor')->name('color.update');
            Route::post('/color/remove', 'Admin\ProductsController@removeColor')->name('color.remove');
            Route::post('/color/update-status', 'Admin\ProductsController@updateStatusColor')->name('color.status');
 
            Route::get('/size', 'Admin\ProductsController@size')->name('size');
            Route::post('/size', 'Admin\ProductsController@postSize')->name('size.create');
            Route::post('/size/update', 'Admin\ProductsController@updateSize')->name('size.update');
            Route::post('/size/remove', 'Admin\ProductsController@removeSize')->name('size.remove');
            Route::post('/size/update-status', 'Admin\ProductsController@updateStatusSize')->name('size.status');
            
            Route::post('/brands/remove', 'Admin\BrandsController@remove')->name('brands.remove');
            Route::post('/brands/search', 'Admin\BrandsController@search')->name('brands.search');
            Route::get('/brands/search/{name}', 'Admin\BrandsController@search')->name('brands.search.one');
            Route::post('/brands/update-status', 'Admin\BrandsController@updateStatus')->name('brands.status');
            Route::resource('/brands', 'Admin\BrandsController');
        });


        Route::group(['prefix' => 'partner'], function () {
            
            Route::post('/partners/search', 'Admin\PartnersController@search')->name('partners.search');
            Route::post('/partners/remove-all', 'Admin\PartnersController@removeAll')->name('partners.remove.all');
            Route::post('/partners/update-status', 'Admin\PartnersController@updateStatus')->name('partners.status');
            Route::post('/partners/remove', 'Admin\PartnersController@remove')->name('partners.remove');
            Route::resource('/partners', 'Admin\PartnersController');
        });

        Route::group(['prefix' => 'video'], function () {
            
            Route::post('/videos/update-status', 'Admin\VideosController@updateStatus')->name('videos.status');
            Route::post('/videos/remove', 'Admin\VideosController@remove')->name('videos.remove');
            Route::resource('/videos', 'Admin\VideosController');
        });

        Route::group(['prefix' => 'gallery'], function () {
            
            Route::post('/slides/update-status', 'Admin\SlidesController@updateStatus')->name('slides.status');
            Route::post('/slides/remove', 'Admin\SlidesController@remove')->name('slides.remove');
            Route::post('/slides/remove-all', 'Admin\SlidesController@removeAll')->name('slides.remove.all');
            Route::resource('/slides', 'Admin\SlidesController');
            
            Route::get('/image-manager', 'Admin\GalleriesController@showGallery')->name('image-manager');
            Route::post('/galleries/update-status', 'Admin\GalleriesController@updateStatus')->name('galleries.status');
            Route::post('/galleries/remove', 'Admin\GalleriesController@remove')->name('galleries.remove');
            Route::post('/galleries/remove-all', 'Admin\GalleriesController@removeAll')->name('galleries.remove.all');
            Route::resource('/galleries', 'Admin\GalleriesController');
    
        });
        
        Route::group(['prefix' => 'menu'], function () {
            
            Route::post('/menus/remove', 'Admin\MenuController@remove')->name('menus.remove');
            Route::post('/menus/update-status', 'Admin\MenuController@updateStatus')->name('menus.status');
            Route::get('/menus/search/{id}', 'Admin\MenuController@search')->name('menus.search.location');
            Route::post('/menus/search', 'Admin\MenuController@searchMenu')->name('menus.search.menu');
            Route::resource('/menus', 'Admin\MenuController');
            
            Route::post('/menu-location/remove', 'Admin\MenuLocationController@remove')->name('menu-location.remove');
            Route::post('/menu-location/update-status', 'Admin\MenuLocationController@updateStatus')->name('menu-location.status');
            Route::get('/menu-location/search/{id}', 'Admin\MenuLocationController@search')->name('menu-location.search.menu');
            Route::post('/menu-location/search', 'Admin\MenuLocationController@searchLocation')->name('menu-location.search.location');
            Route::resource('/menu-location', 'Admin\MenuLocationController');
        });

        Route::group(['prefix' => 'config'], function () {
            
            Route::get('/contact', 'Admin\ConfigController@contact')->name('config.contact');
            Route::post('/contact/{id}', 'Admin\ConfigController@postContact')->name('config.postcontact');
    
            Route::get('/display', 'Admin\ConfigController@display')->name('config.display');
            Route::post('/display/{id}', 'Admin\ConfigController@postdisplay')->name('config.postdisplay');
    
            Route::get('/social', 'Admin\ConfigController@social')->name('config.social');
            Route::post('/social', 'Admin\ConfigController@postSocial')->name('config.social.create');
            Route::post('/social/update', 'Admin\ConfigController@updateSocial')->name('config.social.update');
            Route::post('/social/remove', 'Admin\ConfigController@removeSocial')->name('config.social.remove');
            Route::post('/social/update-status', 'Admin\ConfigController@updateStatus')->name('config.social.status');
    
            Route::get('/language', 'Admin\ConfigController@language')->name('config.language');
            Route::post('/language', 'Admin\ConfigController@postLanguage')->name('config.language.create');
            Route::post('/language/update', 'Admin\ConfigController@updateLanguage')->name('config.language.update');
            Route::post('/language/remove', 'Admin\ConfigController@removeLanguage')->name('config.language.remove');
            Route::post('/language/update-status', 'Admin\ConfigController@updateLanguageStatus')->name('config.language.status');
    
            Route::get('/', 'Admin\ConfigController@general')->name('config');
            Route::post('/general/{id}', 'Admin\ConfigController@postGeneral')->name('config.postgeneral');
        });

        Route::get('/re-sitemap', 'Admin\ConfigController@sitemap')->name('sitemap');


    });




Auth::routes();
