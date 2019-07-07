<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class TourStandardView extends Model
{
    public function tourStandard()
    {
        return $this->belongsTo('App\Model\TourStandard');
    }
}
