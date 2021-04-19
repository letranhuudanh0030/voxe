<?php

namespace App\Http\Controllers\Admin;

use App\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use League\CommonMark\Extension\HeadingPermalink\Slug\SlugGeneratorInterface;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories = ProductCategory::sortable(['id' => 'desc'])->get();
        $categories = ProductCategory::all();
        return view('admin.productCategories.index')->with('title_page', 'danh mục sản phẩm')
                                                    ->with('create_page', 'product-type.create')
                                                    ->with('list_page', 'product-type.index')
                                                    ->with('productCategories', $productCategories)
                                                    ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        return view('admin.productCategories.create')->with('title_page', 'thêm sản phẩm')
                                                    ->with('create_page', 'product-type.create')
                                                    ->with('list_page', 'product-type.index')
                                                    ->with('productCategories', $productCategories)
                                                    ->with('productCategory', null);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:product_categories'
        ]);

        if($request->parent_id) {
            $parent_id = $request->parent_id;
        } else {
            $parent_id = 0;
        }

        $slug = null;
        if($request->slug){
            $slug = $request->slug;
        } else {
            $slug = Str::slug($request->name, '-');
        }


        $category = ProductCategory::create([
            'name' => $request->name,
            'parent_id' => $parent_id,
            'avatar_image' => str_replace(url('/'),'',$request->avatar_image),
            'short_desc' => $request->short_desc,
            'ad_content' => $request->ad_content,
            'publish' => $request->publish,
            'highlight' => $request->highlight,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keywords,
            'meta_desc' => $request->meta_description,
            'slug' => $slug,
        ]);

        $data_pivot = [];

        if($request->language){

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

            $category->language()->attach($data_pivot);
        }

        Session::flash('success', 'Thêm sản phẩm thành công.');

        if($request->back) {
            return redirect()->back();
        } else {
            return redirect()->route('product-type.index');
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
        $productCategory = ProductCategory::findOrFail($id);
        $categories = ProductCategory::all();
        return view('admin.productCategories.edit')->with('title_page', 'danh mục sản phẩm')
                                                    ->with('create_page', 'product-type.create')
                                                    ->with('list_page', 'product-type.index')
                                                    ->with('productCategories', $categories)
                                                    ->with('productCategory', $productCategory);
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
            'name' => 'required'
        ]);



        $productCategory = ProductCategory::findOrfail($id);
        $productCategory->name = $request->name;

        if($request->parent_id) {
            $productCategory->parent_id = $request->parent_id;
        } else {
            $productCategory->parent_id = 0;
        }

        if($request->avatar_image){
            $productCategory->avatar_image = str_replace(url('/'),'',$request->avatar_image);
        }
        $slug = null;
        if($request->slug){
            $slug = $request->slug;
        } else {
            $slug = Str::slug($request->name, '-');
        }

        $productCategory->short_desc = $request->short_desc;
        $productCategory->ad_content = $request->ad_content;
        $productCategory->publish = $request->publish;
        $productCategory->highlight = $request->highlight;
        $productCategory->meta_title = $request->meta_title;
        $productCategory->meta_keyswords = $request->meta_keywords;
        $productCategory->meta_desc = $request->meta_description;
        $productCategory->slug = $slug;
        $productCategory->updated_at = Carbon::now();
        $productCategory->save();

        $data_pivot = [];
        
        if($request->language){
            for ($i=0; $i < count($request->language); $i++) {
                
                if(empty($request->slug_lang[$i])){
                    $slug_lang = Str::slug($request->name_lang[$i], '-');
                } else {
                    $slug_lang = $request->slug_lang[$i];
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
    
            $productCategory->language()->sync($data_pivot);
        }

        Session::flash('success', 'Cập nhật danh mục sản phẩm thành công.');

        if($request->back) {
            return redirect()->back();
        } else {
            return redirect()->route('product-type.index');
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
        $productCategory = ProductCategory::find($data['id']);
        if($data['name'] == 'publish') {
            $productCategory->publish = $data['value'];
        } elseif ($data['name'] == 'highlight') {
            $productCategory->highlight = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $productCategory->sort_order = $data['value'];
        }
        $productCategory->updated_at = Carbon::now();
        $productCategory->save();

    }

    public function search($name = null)
    {
        $productCategories = null;
        $categories = ProductCategory::all();
        
        if($name) {
            $productCategories = ProductCategory::where('name', $name)->sortable()->paginate(10);
        } else {

            if(request()->search_name) {
                $productCategory = ProductCategory::where('name','LIKE', request()->search_name.'%')->first();
                $isParentCate = $categories->where('parent_id', $productCategory->id)->first();
                if($isParentCate){
                    foreach ($categories->where('parent_id', $productCategory->id) as $key => $category) {
                        $productCategories[] = $category;                
                    }
                } else {
                    $productCategories = $productCategory;
                }
               
            } else {
                $productCategories = $categories;
            }
        }

        
        $productCategoriesCollect = collect($productCategories);
        
        // dd($productCategoriesCollect);

        return view('admin.productCategories.index')->with('title_page', 'Danh mục bài viết')
                                            ->with('productCategories', $productCategoriesCollect)
                                            ->with('categories', $categories)
                                            ->with('create_page', 'product-type.create')
                                            ->with('list_page', 'product-type.index');
    }

    public function remove()
    {
        $productCategory = ProductCategory::findOrFail(request()->id);
        $product = $productCategory->products();

        $product->delete();

        if($product->count() == 0){
            $productCategory->delete();
        }

        $product->language()->detach();

    }


    public function removeAll()
    {
        $ids = explode(',', request()->ids);
        // dd($ids);
        foreach ($ids as $id) {
            if($id != '' && $id != 25) {
                $productCategory = ProductCategory::findOrFail($id);
                // dd($productCategory);
                $productCategory->language()->sync([]);
                $productCategory->delete();
            }
        }
    }
}
