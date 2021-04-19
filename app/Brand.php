<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Brand extends Model
{
    use Sortable;

    protected $fillable = ['name', 'publish', 'avatar_image', 'meta_title', 'meta_keywords', 'meta_desc','slug', 'publish', 'sort_order', 'parent_id'];

    protected $sortable = ['id', 'created_at', 'sort_order'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
