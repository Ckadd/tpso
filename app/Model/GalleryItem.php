<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class GalleryItem extends Model
{
    /**
     * Relation with table gallery.
     *
     * @return void
     */
    public function gallery()
    {
        return $this->belongTo('App\Model\Gallery');
    }
}
