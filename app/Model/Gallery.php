<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Gallery extends Model
{
    /**
     * Relation with table galleryItem.
     *
     * @return void
     */
    public function galleryItem()
    {
        return $this->hasMany('App\Model\GalleryItem', 'gallery_id', 'id');
    }
}
