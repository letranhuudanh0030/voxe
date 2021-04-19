<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use App\Color;
use App\District;
use App\Size;
use App\Ward;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::sortable(['id' => 'desc'])->paginate(10);
        // $products = Product::all();
        $productCategories = ProductCategory::all();
        return view('admin.products.index')->with('title_page', 'danh sách sản phẩm')
                                            ->with('create_page', 'products.create')
                                            ->with('list_page', 'products.index')
                                            ->with('products', $products)
                                            ->with('productCategories', $productCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::where('publish', 1)->get();
        $brands = Brand::where('publish', 1)->get();
        $colors = Color::where('publish', 1)->get();
        $sizes = Size::where('publish', 1)->get();

        return view('admin.products.create')->with('title_page', 'thêm sản phẩm')
                                            ->with('create_page', 'products.create')
                                            ->with('list_page', 'products.index')
                                            ->with('productCategories', $productCategories)
                                            ->with('brands', $brands)
                                            ->with('product', null)
                                            ->with('colors', $colors)
                                            ->with('sizes', $sizes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|unique:products',
            'category_id' => 'required',
            // 'brand_id' => 'required',
            'short_desc' => 'required',
            'content' => 'required'
            ]);


        $images = null;
        if($request->images){
            $imgArr = json_decode($request->images);
            if(is_array($imgArr)){

                foreach ($imgArr as $key => $image) {
                    if($key > 0){

                        $images .= ',' . str_replace(url('/'),'', $image);
                    }else {
                        $images .= str_replace(url('/'),'', $image);
                    }
                }
            } else {
                $images = $request->images;
            }
        }




        $slug = null;
        if($request->slug){
            $slug = $request->slug;
        } else {
            $slug = Str::slug($request->title, '-');
        }


        $product = Product::create([
            'title' => $request->title,
            'str_id' => $request->str_id,
            'price' => $request->price,
            'dis_price' => $request->dis_price,
            'product_category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'avatar_image' => str_replace(url('/'),'',$request->avatar_image),
            'images' => $images,
            'short_desc' => $request->short_desc,
            'content' => $request->content,
            'publish' => $request->publish,
            'highlight' => $request->highlight,
            'lastest' => $request->lastest,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keywords,
            'meta_desc' => $request->meta_description,
            'slug' => $slug,
        ]);

        $product_color = Product::findOrFail($product->id);

        $product_color->color()->sync($request->color);

        $product_size = Product::findOrFail($product->id);

        $product_size->size()->sync($request->size);


        $data_pivot = [];
        if($request->language) {

            for ($i=0; $i < count($request->language); $i++) {
                $slug_lang = '';
                if($request->slug_lang[$i]){
                    $slug_lang = $request->slug_lang[$i];
                } else {
                    $slug_lang = Str::slug($request->name_lang[$i], '-');
                }
                $data_pivot[$request->language[$i]] = [
                    'title' => $request->name_lang[$i],
                    'short_desc' => $request->short_desc_lang[$i],
                    'content' => $request->content_lang[$i],
                    'meta_title' => $request->meta_title_lang[$i],
                    'slug' => $slug_lang,
                    'meta_keyword' => $request->meta_keyword_lang[$i],
                    'meta_desc' => $request->meta_desc_lang[$i],
                ];
            }

            $product->language()->attach($data_pivot);
        }

        Session::flash('success', 'Thêm sản phẩm thành công.');

        if($request->close){
            return redirect()->route('products.index');
        } else {
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        $colors = Color::where('publish', 1)->get();
        $sizes = Size::where('publish', 1)->get();

        return view('admin.products.edit')->with('title_page', 'thêm sản phẩm')
                                            ->with('create_page', 'products.create')
                                            ->with('list_page', 'products.index')
                                            ->with('productCategories', $productCategories)
                                            ->with('brands', $brands)
                                            ->with('product', $product)
                                            ->with('colors', $colors)
                                            ->with('sizes', $sizes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            // 'brand_id' => 'required',
            'short_desc' => 'required',
            'content' => 'required'
        ]);

        $images = null;
        if($request->images){
            $imgArr = json_decode($request->images);
            if(is_array($imgArr)){


                foreach ($imgArr as $key => $image) {
                    if($key > 0){

                        $images .= ',' . str_replace(url('/'),'', $image);
                    }else {
                        $images .= str_replace(url('/'),'', $image);
                    }
                }
            } else {
                $images = $request->images;
            }
        }


        $product = Product::find($id);
        $product->title = $request->title;
        $product->str_id = $request->str_id;
        $product->price = $request->price;
        $product->dis_price = $request->dis_price;
        $product->product_category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        if($request->avatar_image) {

            $product->avatar_image = str_replace(url('/'),'',$request->avatar_image);
        }
        if($images) {
            $product->images = $images;
        }
        $product->short_desc = $request->short_desc;
        $product->content = $request->content;
        $product->publish = $request->publish;
        $product->highlight = $request->highlight;
        $product->lastest = $request->lastest;
        $product->meta_title = $request->meta_title;
        $product->meta_keyword = $request->meta_keywords;
        $product->meta_desc = $request->meta_description;
        $product->slug = Str::slug($request->title, '-');
        $product->updated_at = Carbon::now();

        $product->save();

        $data_pivot = [];
        if($request->language) {

            for ($i=0; $i < count($request->language); $i++) {
                $data_pivot[$request->language[$i]] = [
                    'title' => $request->name_lang[$i],
                    'short_desc' => $request->short_desc_lang[$i],
                    'content' => $request->content_lang[$i],
                    'meta_title' => $request->meta_title_lang[$i],
                    'slug' => $request->slug_lang[$i],
                    'meta_keyword' => $request->meta_keyword_lang[$i],
                    'meta_desc' => $request->meta_desc_lang[$i],
                ];
            }
        }

        $product->color()->sync($request->color);
        $product->size()->sync($request->size);
        $product->language()->sync($data_pivot);

        Session::flash('success', 'Cập nhật sản phẩm thành công.');
        if($request->back){
            return redirect()->back();
        } else {
            return redirect()->route('products.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus()
    {
        $data = request()->all();
        // dd($data);
        $product = Product::find($data['id']);
        if($data['name'] == 'publish') {
            $product->publish = $data['value'];
        } elseif ($data['name'] == 'highlight') {
            $product->highlight = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $product->sort_order = $data['value'];
        } elseif ($data['name'] == 'lastest') {
            $product->lastest = $data['value'];
        }
        $product->updated_at = Carbon::now();
        $product->save();

        return response($product);
    }

    public function remove()
    {
        $product = Product::find(request()->id);
        $product->delete();
        $product->language()->dettach();
    }

    public function removeAll()
    {
        $ids = explode(',', request()->ids);


        foreach ($ids as $id) {
            if($id != '') {
                $product = Product::find($id);
                $product->delete();
                if($product->pivot){
                    $product->language()->dettach();
                }
            }
        }
    }

    public function search()
    {
        $where = [];
        if(request()->search_name){
            $where[] = ['title', 'like', request()->search_name . '%'];
        } elseif (request()->search_cate) {
            $where[] = ['product_category_id', '=', request()->search_cate];
        } elseif (request()->search_name != null && request()->search_cate != null) {
            $where[] = ['title', 'like', request()->search_name . '%'];
            $where[] = ['article_category_id', '=', request()->search_cate];
        } else {
            $where = [];
        }

        $product = null;
        if(request()->showItem != "0"){
            $product = Product::where($where)->sortable(['created_at' => 'desc'])->paginate(request()->showItem);
        }else{
            $product = Product::where($where)->sortable(['created_at' => 'desc'])->get();
        }
      
        $productCategories = ProductCategory::all();
        return view('admin.products.index')->with('title_page', 'danh sách sản phẩm')
                                            ->with('create_page', 'post.create')
                                            ->with('list_page', 'post.index')
                                            ->with('productCategories', $productCategories)
                                            ->with('products', $product);
    }


    public function cateProduct($id_cate)
    {
        $products = Product::where('product_category_id', $id_cate)
        ->paginate(10);

        $productCategories = ProductCategory::all();
        return view('admin.products.index')->with('title_page', 'danh sách sản phẩm')
                                            ->with('create_page', 'post.create')
                                            ->with('list_page', 'post.index')
                                            ->with('productCategories', $productCategories)
                                            ->with('products', $products);

    }


    public function color()
    {
        $colors = Color::all();
        return view('admin.products.color')->with('title_page', 'màu sắc sản phẩm')
                                            ->with('colors', $colors);
    }

    public function postColor()
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);

        Color::create([
            'title' => request()->name,
            'code' => request()->product_color,
            'slug' => Str::slug(request()->name,'-')
        ]);

        Session::flash('success', 'Thêm mới màu sắc thành công.');

        return redirect()->back();
    }

    public function updateStatusColor()
    {
        $color = Color::findOrFail(request()->id);
        $color->publish = request()->value;
        $color->save();
    }

    public function removeColor()
    {
        $color = Color::findOrFail(request()->id);
        $color->delete();
    }

    public function updateColor()
    {
        // dd(request()->all());
        $color = Color::findOrFail(request()->id);
        $color->title = request()->name;
        $color->code = request()->code;
        $color->slug = Str::slug(request()->name,'-');
        $color->updated_at = Carbon::now();

        $color->save();

        return response($color, 200);
    }


    public function size()
    {
        $sizes = Size::all();
        return view('admin.products.size')->with('title_page', 'size sản phẩm')
                                            ->with('sizes', $sizes);
    }

    public function postSize()
    {

        // dd(request()->all());
        $this->validate(request(), [
            'name' => 'required',
        ]);

        Size::create([
            'title' => request()->name,
            'code' => request()->code,
            'slug' => Str::slug(request()->name, '-')
        ]);

        Session::flash('success', 'Thêm mới size thành công.');

        return redirect()->back();
    }

    public function updateStatusSize()
    {
        $size = Size::findOrFail(request()->id);
        $size->publish = request()->value;
        $size->save();
    }

    public function removeSize()
    {
        $size = Size::findOrFail(request()->id);
        $size->delete();
    }

    public function updateSize()
    {
        // dd(request()->all());
        $size = Size::findOrFail(request()->id);
        $size->title = request()->name;
        $size->code = request()->code;
        $size->slug = Str::slug(request()->name, '-');
        $size->updated_at = Carbon::now();

        $size->save();

        return response($size, 200);
    }
}
