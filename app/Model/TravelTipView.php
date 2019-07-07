<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class TravelTipView extends Model
{
    public function travelTip()
    {
        return $this->belongsTo('App\Model\TravelTip');
    }
}
