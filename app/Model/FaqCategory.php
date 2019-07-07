<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    /**
     * Relation with table faq.
     *
     * @return void
     */
    public function faqs()
    {
        return $this->hasMany('App\Model\Faq', 'faq_category_id', 'id');
    }
}
