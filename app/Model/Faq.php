<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * Relation with table sharingview.
     *
     * @return App\Model\FaqCategory
     */

    public function faqCategory()
    {
        return $this->belongsTo('App\Model\FaqCategory');
    }
}
