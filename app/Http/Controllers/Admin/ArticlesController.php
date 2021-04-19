<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleCategories = ArticleCategory::all();
        $articles = Article::sortable(['id' => 'desc'])->paginate(10);

        return view('admin.articles.index')->with('title_page', 'danh sách bài viết')
                                            ->with('create_page', 'post.create')
                                            ->with('list_page', 'post.index')
                                            ->with('articleCategories', $articleCategories)
                                            ->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articleCategories = ArticleCategory::all();
        $tags = Tag::where('publish', 1)->get();
        return view('admin.articles.create')->with('title_page', 'thêm bài viết')
                                            ->with('create_page', 'post.create')
                                            ->with('list_page', 'post.index')
                                            ->with('articleCategories', $articleCategories)
                                            ->with('tags', $tags)
                                            ->with('article', null);
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
            'title' => 'required',
            'category_id' => 'required',
            'short_desc' => 'required',
            'content' => 'required',
            'meta_title' => 'max:160',
            'meta_keyword' => 'max:160',
            'meta_description' => 'max:160'
        ]);

        $slug = '';
        if($request->slug){
            $slug = $request->slug;
        } else {
            $slug = Str::slug($request->title, '-');
        }

        $article = Article::create([
            'title' => $request->title,
            'article_category_id' => $request->category_id,
            'avatar_image' => str_replace(url('/'),'',$request->avatar_image),
            'short_desc' => $request->short_desc,
            'content' => $request->content,
            'publish' => $request->publish,
            'highlight' => $request->highlight,
            'lastest' => $request->lastest,
            'meta_title' => $request->meta_title,
            'slug' => $slug,
            'meta_keywords' => $request->meta_keywords,
            'meta_desc' => $request->meta_description,
            'check_question' => $request->check_question

        ]);

        $article_tag = Article::findOrFail($article->id);

        $article_tag->tag()->sync($request->tag);

        $data_pivot = [];

        if($request->language){

            $qa_lang = null;
            if($request->question_lang && $request->anwser_lang) {
                foreach ($request->question_lang as $indexqa_lang => $question_lang) {
                    foreach ($request->anwser_lang as $indexan_lang => $anwser_lang) {
                        if($indexqa_lang == $indexan_lang){
                            $qa_lang['question'.$indexqa_lang] = $question_lang;
                            $qa_lang['anwser'.$indexqa_lang] = $anwser_lang;
                        }
                    }
                }
            }

            for ($i=0; $i < count($request->language); $i++) {
                $data_pivot[$request->language[$i]] = [
                    'title' => $request->name_lang[$i],
                    'short_desc' => $request->short_desc_lang[$i],
                    'content' => isset($qa_lang) ? json_encode($qa_lang) : $request->content_lang[$i],
                    'meta_seo' => $request->meta_title_lang[$i],
                    'slug' => $request->slug_lang[$i],
                    'meta_keyword' => $request->meta_keyword_lang[$i],
                    'meta_desc' => $request->meta_desc_lang[$i],
                ];
            }
        }

        $article->language()->attach($data_pivot);

        Session::flash('success', 'Thêm bài viết thành công.');

        if($request->close) {
            return redirect()->route('post.index');
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
        $articleCategories = ArticleCategory::all();
        $article = Article::findOrFail($id);
        $tags = Tag::where('publish', 1)->get();
        // dd($article->tag);
        return view('admin.articles.edit')->with('title_page', 'thêm bài viết')
                                            ->with('create_page', 'post.create')
                                            ->with('list_page', 'post.index')
                                            ->with('articleCategories', $articleCategories)
                                            ->with('article', $article)
                                            ->with('tags', $tags);
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
            'short_desc' => 'required',
            'content' => 'required',
            'meta_title' => 'max:160',
            'meta_keyword' => 'max:160',
            'meta_description' => 'max:160'
        ]);

        $article = Article::find($id);
        $article->title = $request->title;
        $article->article_category_id = $request->category_id;
        if($request->avatar_image) {
            $article->avatar_image = str_replace(url('/'),'',$request->avatar_image);
        }
        $article->short_desc = $request->short_desc;
        $article->content = $request->content;
        $article->publish = $request->publish;
        $article->highlight = $request->highlight;
        $article->lastest = $request->lastest;
        $article->meta_title = $request->meta_title;
        $article->check_question = $request->check_question;
        if($request->slug){
            $article->slug = $request->slug;
        } else {
            $article->slug = Str::slug($request->title, '-');
        }
        $article->meta_keywords = $request->meta_keywords;
        $article->meta_desc = $request->meta_description;
        $article->updated_at = Carbon::now();

        $article->tag()->sync($request->tag);

        $article->save();

        $data_pivot = [];
        if($request->language) {

            for ($i=0; $i < count($request->language); $i++) {


                $qa_lang = null;
                if($request->question_lang && $request->anwser_lang) {
                    foreach ($request->question_lang as $indexqa_lang => $question_lang) {
                        foreach ($request->anwser_lang as $indexan_lang => $anwser_lang) {
                            if($indexqa_lang == $indexan_lang){
                                $qa_lang[$question_lang] = $anwser_lang;
                            }
                        }
                    }
                }

                $slug_lang = '';
                if($request->slug_lang[$i]){
                    $slug_lang = $request->slug_lang[$i];
                } else {
                    $slug_lang = Str::slug($request->name_lang[$i], '-');
                }

                $data_pivot[$request->language[$i]] = [
                    'title' => $request->name_lang[$i],
                    'short_desc' => $request->short_desc_lang[$i],
                    'content' => isset($qa_lang) ? json_encode($qa_lang) : $request->content_lang[$i],
                    'meta_seo' => $request->meta_title_lang[$i],
                    'slug' => $slug_lang,
                    'meta_keyword' => $request->meta_keyword_lang[$i],
                    'meta_desc' => $request->meta_desc_lang[$i],
                ];
            }
        }

        $article->language()->sync($data_pivot);

        Session::flash('success', 'Cập nhật bài viết thành công.');

        if($request->close) {
            return redirect()->route('post.index');
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
        //
    }

    public function remove()
    {
        $article = Article::find(request()->id);
        $article->language()->sync([]);
        $article->delete();
    }

    public function removeAll()
    {
        $ids = explode(',', request()->ids);

        // dd($ids);
        foreach ($ids as $id) {
            if($id != '') {
                $article = Article::find($id);
                // dd($article);
                $article->language()->sync([]);
                $article->delete();
            }
        }

    }

    public function updateStatus()
    {
        $data = request()->all();

        $article = Article::find($data['id']);

        if($data['name'] == 'publish') {
            $article->publish = $data['value'];
        } elseif ($data['name'] == 'highlight') {
            $article->highlight = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $article->sort_order = $data['value'];
        } elseif ($data['name'] == 'lastest') {
            $article->lastest = $data['value'];
        }
        $article->updated_at = Carbon::now();
        $article->save();

    }

    public function search($id = null)
    {

        if($id) {
            $articles = Article::sortable(['created_at' => 'desc'])->where('article_category_id', $id)->paginate(10);
        } else {
            if(request()->search_name){
                $articles = Article::where('title', 'like', request()->search_name . '%')
                ->sortable(['created_at' => 'desc'])->paginate(10);
            } elseif (request()->search_cate) {
                $articles = Article::where('article_category_id', '=', request()->search_cate)
                ->sortable(['created_at' => 'desc'])->paginate(10);
            } elseif (request()->search_name != null && request()->search_cate != null) {
                $articles = Article::where([
                    ['title', 'like', request()->search_name . '%'],
                    ['article_category_id', '=', request()->search_cate]
                ])->sortable(['created_at' => 'desc'])->paginate(10);
            } else {
                $articles = Article::sortable(['created_at' => 'desc'])->paginate(10);
            }
        }


        $articleCategories = ArticleCategory::all();
        return view('admin.articles.index')->with('title_page', 'danh sách bài viết')
                                            ->with('create_page', 'post.create')
                                            ->with('list_page', 'post.index')
                                            ->with('articleCategories', $articleCategories)
                                            ->with('articles', $articles);
    }


    public function tag()
    {
        $tags = Tag::orderBy('created_at', 'desc')->get();
        return view('admin.articles.tag')->with('title_page', 'Tags')
                                        ->with('tags', $tags);
    }

    public function postTag()
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);

        Tag::create([
            'name' => request()->name,
            'url' => request()->link,
            'publish' => 0
        ]);

        Session::flash('success', 'Thêm mới tag thành công.');

        return redirect()->back();
    }

    public function updateStatusTag()
    {
        $tag = Tag::findOrFail(request()->id);
        $tag->publish = request()->value;
        $tag->save();
    }

    public function removeTag()
    {
        $tag = Tag::findOrFail(request()->id);
        $tag->delete();
    }

    public function updateTag()
    {
        $tag = Tag::findOrFail(request()->id);
        $tag->name = request()->name;
        $tag->url = request()->link;
        $tag->updated_at = Carbon::now();

        $tag->save();

        return response($tag, 200);
    }
}
