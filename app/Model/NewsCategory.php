<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    /**
     * Get News.
     */
    public function getNews() {
        return $this->hasMany('App\Model\News', 'category_id');
    }
}
