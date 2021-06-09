<?php

namespace App\Models;

use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $appends = ['category'];

    protected $table = 'articles';

    protected $primaryKey = 'article_id';

    /**
     * Define article author relationship
     */
    public function articleAuthor()
    {
        return $this->hasOne('App\Models\Admin', 'admin_id', 'article_author');
    }

    /**
     * Define article category relationship
     */
    public function articleCategory()
    {
        return $this->hasOne('App\Models\ArticleCategory', 'category_id', 'article_cat_id');
    }

    public function getCategoryAttribute()
    {
        $category = '';
        $catId = $this->article_cat_id;

        if ($catId) {
            $getCategory = @ArticleCategory::where('category_id', $catId)->first();
            if ($getCategory) {
                $category = $getCategory->category_name;
            }

        }
        return $this->attributes['category'] = $category;

    }
}
