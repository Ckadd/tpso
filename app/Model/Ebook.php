<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Ebook extends Model
{
    /**
     * Relation with table ebook.
     *
     * @return App\Model\Ebook
     */
    public function ebookCategory()
    {
        return $this->belongTo('App\Model\EbookCategory');
    }
}
