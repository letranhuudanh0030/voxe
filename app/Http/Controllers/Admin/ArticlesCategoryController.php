<?php

namespace App\Http\Controllers\Admin;

use App\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ArticlesCategoryController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleCategories = ArticleCategory::all();
        $articleCategoryList = ArticleCategory::sortable(['id' => 'desc'])->paginate(10);

        // dd($articleCategories);

        return view('admin.articleCategories.index')->with('title_page', 'danh mục bài viết')
                                                    ->with('articleCategories', $articleCategoryList)
                                                    ->with('categories', $articleCategories)
                                                    ->with('create_page', 'catalogue.create')
                                                    ->with('list_page', 'catalogue.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articleCategory = ArticleCategory::all();
        return view('admin.articleCategories.create')->with('title_page', 'thêm danh mục')
                                            ->with('articleCategories', $articleCategory)
                                            ->with('create_page', 'catalogue.create')
                                            ->with('list_page', 'catalogue.index')
                                            ->with('articleCategory', null);
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
            'name' => 'required'
        ]);

        $slug = '';
        if($request->slug){
            $slug = $request->slug;
        } else {
            $slug = Str::slug($request->name, '-');
        }

        $category = ArticleCategory::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'page_type' => $request->page_type,
            'cate_image' => str_replace(url('/'),'',$request->cate_image),
            'avatar_image' => str_replace(url('/'),'',$request->avatar_image),
            'short_desc' => $request->short_desc,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keywords,
            'meta_desc' => $request->meta_description,
            'slug' => $slug,
            'publish' => $request->publish,
            'highlight' => $request->highlight,
            'one_article' => $request->one_article,
            'un_link' => $request->unlink,
        ]);

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
                    // 'url' => $request->short_desc_lang[$i],
                    'short_desc' => $request->short_desc_lang[$i],
                    'meta_title' => $request->meta_title_lang[$i],
                    'slug' => $slug_lang,
                    'meta_keyword' => $request->meta_keyword_lang[$i],
                    'meta_desc' => $request->meta_desc_lang[$i],
                ];
            }
        }

        $category->language()->attach($data_pivot);

        Session::flash('success', 'Tạo danh mục bài viết thành công.');

        if($request->close) {
            return redirect()->route('catalogue.index');
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
        $articleCategory = ArticleCategory::findOrFail($id);
        $articleCategories = ArticleCategory::all();
        // dd($articleCategory);
        return view('admin.articleCategories.edit')->with('title_page', 'Cập nhật danh mục')
                                        ->with('articleCategory', $articleCategory)
                                        ->with('articleCategories', $articleCategories)
                                        ->with('create_page', 'catalogue.create')
                                        ->with('list_page', 'catalogue.index');;
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
        
        $this->validate($request, [
            'name' => 'required'
        ]);

        $articleCategory = ArticleCategory::find($id);

        $articleCategory->name = $request->name;
        $articleCategory->parent_id = $request->parent_id;
        $articleCategory->page_type = $request->page_type;
        if($request->cate_image){

            $articleCategory->cate_image = str_replace(url('/'),'',$request->cate_image);
        }
        if($request->avatar_image){

            $articleCategory->avatar_image = str_replace(url('/'),'',$request->avatar_image);
        }
        $articleCategory->short_desc = $request->short_desc;
        $articleCategory->meta_title = $request->meta_title;
        $articleCategory->meta_keywords = $request->meta_keywords;
        $articleCategory->meta_desc = $request->meta_description;

        if($request->slug) {
            $articleCategory->slug = $request->slug;
        } else {

            $articleCategory->slug = Str::slug($request->name, '-');
        }

        $articleCategory->publish = $request->publish;
        $articleCategory->highlight = $request->highlight;
        $articleCategory->one_article = $request->one_article;
        $articleCategory->un_link = $request->unlink;
        $articleCategory->link = $request->link;
        $articleCategory->updated_at = Carbon::now();


        $articleCategory->save();

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
                    // 'url' => $request->short_desc_lang[$i],
                    'short_desc' => $request->short_desc_lang[$i],
                    'meta_title' => $request->meta_title_lang[$i],
                    'slug' => $slug_lang,
                    'meta_keyword' => $request->meta_keyword_lang[$i],
                    'meta_desc' => $request->meta_desc_lang[$i],
                ];
            }
        }

        $articleCategory->language()->sync($data_pivot);

        Session::flash('success', 'Cập nhật danh mục bài viết thành công.');

        if($request->close) {
            return redirect()->route('catalogue.index');
        } else {
            return redirect()->back();
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

    }

    public function remove()
    {
        $articleCategory = ArticleCategory::findOrFail(request()->id);
        $articles = $articleCategory->article();

        foreach ($articleCategory->article()->get() as $article) {
            $article->language()->detach();
            $article->delete();
        }

        if($articles->count() == 0){
            $articleCategory->language()->detach();
            $articleCategory->delete();

        }
    }

    public function removeAll()
    {
        $ids = explode(',', request()->ids);
        // dd($ids);
        foreach ($ids as $id) {
            if($id != '') {
                $articleCategory = ArticleCategory::findOrFail($id);
                // dd($articleCategory);
                $articleCategory->language()->sync([]);
                $articleCategory->delete();
            }
        }
    }

    public function articleDetach($articles)
    {

        return $articles;
    }

    public function search()
    {
        $articleCategoriesearch = ArticleCategory::all();
        if(request()->search_name) {
            $articleCategories = ArticleCategory::where('id', request()->search_name)
                                                ->sortable()->paginate(10);
        } else {
            $articleCategories = ArticleCategory::where('name','LIKE', request()->search_name.'%')
                                                ->sortable()->paginate(10);
        }

        return view('admin.articleCategories.index')->with('title_page', 'Danh mục bài viết')
                                            ->with('articleCategories', $articleCategories)
                                            ->with('categories',$articleCategoriesearch )
                                            ->with('create_page', 'catalogue.create')
                                            ->with('list_page', 'catalogue.index');;
    }

    public function updateStatus()
    {
        $data = request()->all();
        // dd($data);
        $articleCategory = ArticleCategory::find($data['id']);
        if($data['name'] == 'publish') {
            $articleCategory->publish = $data['value'];
        } elseif ($data['name'] == 'highlight') {
            $articleCategory->highlight = $data['value'];
        } elseif ($data['name'] == 'link') {
            $articleCategory->link = $data['value'];
        } elseif ($data['name'] == 'onepage') {
            $articleCategory->one_article = $data['value'];
        } elseif ($data['name'] == 'unlink') {
            $articleCategory->un_link = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $articleCategory->sort_order = $data['value'];
        }
        $articleCategory->updated_at = Carbon::now();
        $articleCategory->save();

    }

}
