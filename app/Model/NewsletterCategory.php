<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class NewsletterCategory extends Model
{
    /**
     * Relation with table newletterDetail.
     *
     * @return void
     */
    public function newletterDetail()
    {
        return $this->hasMany('App\Model\NewletterSubscribeDetail', 'category_id', 'id');
    }
}
