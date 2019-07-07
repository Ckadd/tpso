<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class PublicGuideView extends Model
{
    public function publicGuide()
    {
        return $this->belongsTo('App\Model\PublicGuide');
    }
}
