<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class LibraryBook extends Model
{
    public function libraryBookView()
    {
        return $this->hasMany('App\Model\LibraryBookView','library_book_id','id');
    }
}
