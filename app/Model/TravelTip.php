<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class TravelTip extends Model
{
    public function travelTipView()
    {
        return $this->hasMany('App\Model\TravelTipView','travel_tip_id','id');
    }
}
