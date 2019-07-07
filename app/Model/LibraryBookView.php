<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class LibraryBookView extends Model
{
    public function libraryBook()
    {
        return $this->belongsTo('App\Model\LibraryBook');
    }
}
