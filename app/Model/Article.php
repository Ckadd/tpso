<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    /**
     * relation hasMany to table articleView
     *
     * @return void
     */
    public function articleView()
    {
        return $this->hasMany('App\Model\ArticleView','article_id','id');
    }
}
