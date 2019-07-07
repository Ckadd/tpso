<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class NewletterSubscribeDetail extends Model
{
    /**
     * Relation with table sharingview.
     *
     * @return App\Model\NewsletterCategory
     */

    public function newletterCategory()
    {
        return $this->belongsTo('App\Model\NewsletterCategory');
    }
}
