<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ArticleCategory extends Model
{
    use Sortable;

    protected $fillable = ['name', 'parent_id', 'page_type', 'cate_image', 'avatar_image', 'short_desc', 'meta_title', 'meta_keywords', 'meta_desc','slug', 'publish', 'highlight', 'one_article', 'link', 'un_link', 'sort_order'];

    protected $sortable = ['id', 'name', 'created_at', 'sort_order', 'page_type'];

    public function article()
    {
        return $this->hasMany(Article::class);
    }

    public function menu()
    {
        return $this->hasMany(Menu::class, 'module_item', 'id');
    }

    public function language()
    {
        return $this->belongsToMany(Language::class, 'article_category_language', 'article_category_id', 'language_id')->withPivot('title', 'short_desc', 'meta_title', 'slug', 'meta_keyword', 'meta_desc');
    }

    public static function getCategoryPublish()
    {
        return ArticleCategory::where('publish', 1)->get();
    }

    public function getArticlesPublish()
    {
        return $this->article()->where('publish', 1)->get();
    }
}
