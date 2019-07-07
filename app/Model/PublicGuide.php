<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class PublicGuide extends Model
{
    public function libraryBookView()
    {
        return $this->hasMany('App\Model\PublicGuideView','public_guide_id','id');
    }
}
