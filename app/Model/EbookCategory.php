<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class EbookCategory extends Model
{
     /**
     * Relation with table ebook.
     *
     * @return App\Model\Ebook
     */
    public function ebook()
    {
        return $this->hasMany('App\Model\Ebook','category_id','id');
    }
}
