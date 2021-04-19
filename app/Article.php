<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Article extends Model
{
    use Sortable;

    protected $fillable = ['title', 'article_category_id', 'avatar_image', 'short_desc', 'content', 'publish', 'highlight', 'lastest', 'meta_title', 'slug', 'meta_keywords', 'meta_desc', 'sort_order', 'tag_id', 'check_question'];

    protected $sortable = ['id', 'title', 'sort_order', 'created_at'];

    public function artileCategory()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function language()
    {
        return $this->belongsToMany(Language::class, 'article_language', 'article_id', 'language_id')->withPivot('title', 'short_desc', 'content', 'meta_seo', 'slug', 'meta_keyword', 'meta_desc');
    }
    
}
