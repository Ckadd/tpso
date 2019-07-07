<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class ArticleView extends Model
{
    /**
     * relation belong to article
     *
     * @return void
     */
    public function article()
    {
        return $this->belongsTo('App\Model\Article');
    }
}
