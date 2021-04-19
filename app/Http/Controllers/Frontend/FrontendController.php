<?php

namespace App\Http\Controllers\Frontend;

use App\Article;
use App\ArticleCategory;
use App\ConfigContact;
use App\ConfigGeneral;
use App\Http\Controllers\Controller;
use App\Http\Traits\MyTrait;
use App\Menu;
use App\Product;
use App\ProductCategory;
use App\Question;
use App\Slide;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class FrontendController extends Controller
{

    use MyTrait;

    public function index()
    {
        // $info = phpinfo();
        // dd($info);
        $slides = Slide::getSlidesPublish();
        $videos = Video::getVideosPublish();
        $service_home = ArticleCategory::where('page_type', 11)->first();
        $news_category = ArticleCategory::where('page_type', 7)->where('publish', 1)->first();
        // dd($news_highlight);

        $categories = ProductCategory::getCategoriesPublishAndHighlight();
        $cateall = ProductCategory::getCategoriesPublish();


        return view('frontend.home', [
            'slides' => $slides,
            'videos' => $videos,
            'categories' => $categories,
            'service_home' => $service_home,
            'news_category' => $news_category,
            'cateall' => $cateall,
            'title_page' => 'Sản phẩm của chúng tôi'
        ]);
    }

    public function onePage($slug)
    {
        $page = Menu::where('url', $slug)->first();

        $category_menu = MyTrait::checkCategoryMenu($page);

        // product category
        $category = ProductCategory::getCategoryPublishBySlug($slug);
        $categories = ProductCategory::getCategoriesPublish();

        // news category
        $news_category = ArticleCategory::getCategoryPublish();

        // dd($page);

        if($category_menu){
            if($category_menu->page_type){
                $route_page = MyTrait::checkPageRoute($category_menu->page_type);
                $title_page = $category_menu->name;
                return view("frontend.$route_page")->with('title_page', $title_page)
                                                    ->with('category_menu', $category_menu)
                                                    ->with('news_category', $news_category);
            } else {
                if($page->module_item == 'product'){
                    $products = Product::getProductsPublishByCategoryAndPaginate($category, 8);
                    // dd(123);
                } else {
                    $productList = MyTrait::getProductsByCategoryList($categories, $category);
                    $products = MyTrait::array_pagination($productList, 8);
                    $cateall = ProductCategory::getCategoriesPublish();
                    // dd($products);
                }
                return view('frontend.product_list')->with('category', $category)
                                                    ->with('categories', $categories)
                                                    ->with('products', $products)
                                                    ->with('cateall', $cateall);
            }
        }
    }

    public function categoryProduct($slug, $id)
    {
        // product category
        $category = ProductCategory::getCategoryPublishBySlug($slug);
        $categories = ProductCategory::getCategoriesPublish();

        return view('frontend.product_list')->with('category', $category)
                                            ->with('categories', $categories)
                                            ->with('cateall', $categories);
    }

    public function categoryArticle($slug)
    {
        $news = Article::where('publish', 1)->where('id', request()->id)->first();
        return view('frontend.news_list')->with([
            'news' => $news,
        ]);
    }

    public function singleProduct($slug)
    {
        $product = Product::getProductPublishById(request()->id);
        return view('frontend.product_detail')->with([
            'product' => $product
        ]);
    }

    public function singleArticle($slug)
    {
        $title_page = null;
        // $article = Article::where('slug', $slug)->first();
        $article = Article::where('id', request()->id)->first();

        $article->view++;

        $article->save();

        $question = Question::where('publish', 1)->get();
        
        $title_page = $article->title;


        return view('frontend.news_detail')->with('article_single', $article)
                                        ->with('articles', $article->artileCategory->getArticlesPublish())
                                        ->with('title_page', $title_page)
                                        ->with('questions', $question);
    }

    public function sendMail()
    {
        $user = $this->validate(request(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => '',
            'subject' => ''
        ]);

        $email = ConfigContact::first()->email_rece;
        $info = ConfigGeneral::first();

        Mail::send('frontend.emails.contact.contact-form', ['user' => $user], function ($m) use ($user, $email, $info) {
            $m->from(env('MAIL_USERNAME'), $info->name);

            $m->to($email)->subject($user['subject']);
        });

        Session::flash('success', 'Gửi mail thành công.');

        return redirect()->back();
    }

    public function search()
    {
        $keyword = Str::slug(request()->keyword, '-');
        $products = Product::where('slug', 'like', "%$keyword%")->where('publish', 1)->orderBy("created_at", "desc")->paginate(12);
        return view('frontend.product_list')->with([
            'products' => $products,
            'title_page' => "Từ khóa: ".request()->keyword
        ]);
    }


}
