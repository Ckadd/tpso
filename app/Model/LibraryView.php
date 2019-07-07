<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class LibraryView extends Model
{
    /**
     * Relation with table Library.
     *
     * @return App\Model\Library
     */

    public function library()
    {
        return $this->belongsTo('App\Model\Library');
    }
}
