<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Library extends Model
{
    protected $table = 'libraries';
     /**
     * Relation with table LibraryView.
     *
     * @return App\Model\LibraryView
     */
    public function libraryView()
    {
        return $this->hasMany('App\Model\LibraryView','library_id','id');
    }
}
