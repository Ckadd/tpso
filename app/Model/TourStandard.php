<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class TourStandard extends Model
{
    public function tourStandardView()
    {
        return $this->hasMany('App\Model\TourStandardView','tour_standard_id','id');
    }
}
